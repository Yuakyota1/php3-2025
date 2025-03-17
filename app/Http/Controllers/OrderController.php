<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->find($id);
    
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }
    
        return view('orders.detail', compact('order'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'orderCode' => 'ORD' . time(),
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'note' => $request->note,
                'total_price' => 0, // Sẽ cập nhật sau
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            $totalPrice = 0;

            foreach ($request->cart_items as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'size' => $item['size'],
                    'color' => $item['color'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                    'image' => $item['image'] ?? null,
                ]);

                $totalPrice += $orderItem->total;
            }

            $order->update(['total_price' => $totalPrice]);

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    public function cancel($id)
{
    $order = Order::findOrFail($id);

    if ($order->status == 'pending') {
        $order->update(['status' => 'canceled']);
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy.');
    }

    return redirect()->route('orders.index')->with('error', 'Không thể hủy đơn hàng này.');
}

public function destroy($id)
{
    $order = Order::findOrFail($id);

    if ($order->status == 'canceled') {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa.');
    }

    return redirect()->route('orders.index')->with('error', 'Chỉ có thể xóa đơn hàng đã hủy.');
}

}
