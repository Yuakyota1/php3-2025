<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\DB;
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
        if ($order->status === 'pending' || $order->status === 'unpaid') {
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
    public function getRevenueData(Request $request)
{
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    $ordersQuery = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
        ->where('status', 'paid');

    if ($startDate) {
        $ordersQuery->whereDate('created_at', '>=', $startDate);
    }
    if ($endDate) {
        $ordersQuery->whereDate('created_at', '<=', $endDate);
    }

    $orders = $ordersQuery
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Lấy số lượng sản phẩm và chi phí nhập hàng
    $itemsQuery = DB::table('order_items')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->join('product_size_colors', 'product_size_colors.id', '=', 'order_items.product_size_color_id')
        ->selectRaw('DATE(orders.created_at) as date, 
                     SUM(order_items.quantity) as total_quantity,
                     SUM(order_items.quantity * product_size_colors.import_price) as total_cost')
        ->where('orders.status', 'paid');

    if ($startDate) {
        $itemsQuery->whereDate('orders.created_at', '>=', $startDate);
    }
    if ($endDate) {
        $itemsQuery->whereDate('orders.created_at', '<=', $endDate);
    }

    $items = $itemsQuery
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Chuẩn bị dữ liệu cho biểu đồ
    $labels = [];
    $revenue = [];
    $realRevenue = [];
    $quantities = [];

    foreach ($orders as $order) {
        $labels[] = $order->date;
        $revenue[] = $order->revenue;

        $match = $items->firstWhere('date', $order->date);
        $cost = $match ? $match->total_cost : 0;
        $qty = $match ? $match->total_quantity : 0;

        $realRevenue[] = $order->revenue - $cost;
        $quantities[] = $qty;
    }

    return response()->json([
        'labels' => $labels,
        'revenue' => $revenue,
        'real_revenue' => $realRevenue,
        'quantity' => $quantities
    ]);
}

    
}

