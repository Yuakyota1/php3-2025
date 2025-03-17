<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
class AdminOrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // Xem chi tiết đơn hàng
    public function show(Order $order)
    {
        return view('admin.orders.detail', compact('order'));
    }
    public function edit($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }
    
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();
    
        // Gửi email nếu trạng thái thay đổi
        if ($oldStatus !== $order->status && $order->user) {
            Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
        }
    
        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
    // Hủy đơn hàng
    public function cancel(Order $order)
    {
        if ($order->status === 'pending') {
            $order->update(['status' => 'canceled']);
            return redirect()->back()->with('success', 'Đơn hàng đã bị hủy.');
        }
        return redirect()->back()->with('error', 'Không thể hủy đơn hàng này.');
    }

    // Xóa đơn hàng
    public function destroy(Order $order)
    {
        if ($order->status === 'canceled') {
            $order->delete();
            return redirect()->back()->with('success', 'Đơn hàng đã được xóa.');
        }
        return redirect()->back()->with('error', 'Chỉ có thể xóa đơn hàng đã hủy.');
    }
}

