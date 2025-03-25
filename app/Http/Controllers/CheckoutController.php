<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use App\Models\ProductSizeColor;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;


class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Lấy giỏ hàng của user từ database
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = $carts->sum(fn($cart) => $cart->price * $cart->quantity);
        $shippingFee = ($total >= 500000) ? 0 : 30000;
        $payableTotal = $total + $shippingFee;

        return view('checkout.index', compact('carts', 'total', 'shippingFee', 'payableTotal'));
    }
    
    public function createVNPayPayment(Order $order)
    {
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');
    
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $order->total_price * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toán đơn hàng #{$order->orderCode}",
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $order->id,
        ];
    
        ksort($inputData);
        $query = http_build_query($inputData);
        $vnp_SecureHash = hash_hmac('sha512', $query, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnp_SecureHash;
    
        return redirect($vnp_Url);
    }
    
    public function placeOrder(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'phone'   => 'required|string|max:15',
        'address' => 'required|string',
        'note'    => 'nullable|string',
        'payment' => 'required|string',
    ]);

    $user = Auth::user();
    $carts = Cart::where('user_id', $user->id)->get();

    if ($carts->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    $total = $carts->sum(fn($cart) => $cart->price * $cart->quantity);
    $shippingFee = ($total >= 500000) ? 0 : 30000;
    $discountAmount = $request->input('discount_amount', 0); // ✅ Nhận giá trị giảm giá từ form
    $payableTotal = max(0, $total + $shippingFee - $discountAmount);

    // Tạo đơn hàng
    $order = Order::create([
        'user_id'        => $user->id,
        'orderCode'      => 'ORD' . time(),
        'name'           => $request->name,
        'email'          => $request->email,
        'phone'          => $request->phone,
        'address'        => $request->address,
        'note'           => $request->note,
        'total_price'    => $payableTotal,
        'discount_applied' => $discountAmount, // ✅ Lưu giảm giá vào DB
        'payment_method' => $request->payment,
        'status'         => ($request->payment === 'vnpay') ? 'unpaid' : 'pending',
    ]);

    foreach ($carts as $cart) {
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $cart->product_id,
            'size'       => $cart->size,
            'color'      => $cart->color,
            'quantity'   => $cart->quantity,
            'price'      => $cart->price,
            'total'      => $cart->price * $cart->quantity,
        ]);
    }

    // Nếu chọn VNPay, chuyển hướng sang VNPay ngay
    if ($request->payment === 'vnpay') {
        return $this->createVNPayPayment($order);
    }

    // Nếu không phải VNPay, xóa giỏ hàng và gửi mail
    Cart::where('user_id', $user->id)->delete();
    Mail::to($request->email)->send(new OrderConfirmationMail($order));

    return redirect()->route('checkout.index')->with('success', 'Đặt hàng thành công!');
}

public function vnpayReturn(Request $request)
{
    $vnp_HashSecret = env('VNP_HASH_SECRET'); // Lấy key bảo mật từ .env
    $inputData = $request->all();
    $secureHash = $inputData['vnp_SecureHash']; // Lấy mã hash từ VNPay
    unset($inputData['vnp_SecureHash']); // Loại bỏ hash để kiểm tra
    ksort($inputData);
    $hashData = http_build_query($inputData);
    $generatedHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    if ($generatedHash === $secureHash) {
        $order = Order::find($inputData['vnp_TxnRef']);
        if ($inputData['vnp_ResponseCode'] == '00') { // Thành công
            $order->status = 'paid';
            $order->save();
            Cart::where('user_id', $order->user_id)->delete();
            Mail::to($order->email)->send(new OrderConfirmationMail($order));
            return redirect()->route('checkout.index')->with('success', 'Thanh toán thành công!');
        } else { // Thất bại
            $order->status = 'failed';
            $order->save();
            return redirect()->route('checkout.index')->with('error', 'Thanh toán thất bại!');
        }
    }

    return redirect()->route('checkout.index')->with('error', 'Xác minh giao dịch thất bại!');
}

}
