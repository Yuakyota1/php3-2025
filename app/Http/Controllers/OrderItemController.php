<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    // Hiển thị danh sách tất cả order_items
    public function index()
    {
        $orderItems = OrderItem::with('order', 'product')->get();
        return response()->json($orderItems);
    }

    // Tạo một order item mới
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $orderItem = OrderItem::create($request->all());

        return response()->json(['message' => 'Sản phẩm đã được thêm vào đơn hàng', 'data' => $orderItem], 201);
    }

    // Hiển thị thông tin một order item cụ thể
    public function show($id)
    {
        $orderItem = OrderItem::with('order', 'product')->find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong đơn hàng'], 404);
        }

        return response()->json($orderItem);
    }

    // Cập nhật thông tin order item
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong đơn hàng'], 404);
        }

        $request->validate([
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'total' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $orderItem->update($request->all());

        return response()->json(['message' => 'Cập nhật sản phẩm trong đơn hàng thành công', 'data' => $orderItem]);
    }

    // Xóa order item
    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong đơn hàng'], 404);
        }

        $orderItem->delete();

        return response()->json(['message' => 'Xóa sản phẩm khỏi đơn hàng thành công']);
    }
}
