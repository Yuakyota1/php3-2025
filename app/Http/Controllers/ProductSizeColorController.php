<?php

namespace App\Http\Controllers;

use App\Models\ProductSizeColor;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductSizeColorController extends Controller
{
    public function index()
    {
        $items = ProductSizeColor::with(['product', 'size'])->get();
        return view('admin.product_size_color.index', compact('items'));
    }
    
    
    public function create()
    {
        $products = Product::all();
        $sizes = Size::all();
        return view('admin.product_size_color.create', compact('products', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idProduct' => 'required|exists:products,id',
            'color' => 'required|string|max:50',
            'idSize' => 'required|exists:sizes,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
    
        // Kiểm tra nếu màu sắc đã tồn tại cho sản phẩm và kích thước này
        $existing = ProductSizeColor::where('idProduct', $request->idProduct)
            ->where('color', $request->color)
            ->where('idSize', $request->idSize)
            ->first();
    
        if ($existing) {
            // Nếu màu sắc đã tồn tại, trả về thông báo lỗi
            return redirect()->route('admin.product_size_color.create')
                ->with('error', 'Màu sắc đã tồn tại cho sản phẩm và kích thước này.');
        }
    
        // Tạo mới bản ghi ProductSizeColor
        ProductSizeColor::create($request->only(['idProduct', 'color', 'idSize', 'quantity', 'price']));
    
        // Nếu thêm thành công, trả về thông báo thành công
        return redirect()->route('admin.product_size_color.index')
            ->with('success', 'Dữ liệu đã được thêm.');
    }
    
    
    public function edit($id)
    {
        $item = ProductSizeColor::findOrFail($id);
        $products = Product::all();
        $sizes = Size::all();
        return view('admin.product_size_color.edit', compact('item', 'products', 'sizes'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'idProduct' => 'required|exists:products,id',
            'color' => 'required|string|max:50',
            'idSize' => 'required|exists:sizes,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $item = ProductSizeColor::findOrFail($id);
        $item->update($request->only(['idProduct', 'color', 'idSize', 'quantity', 'price']));

        return redirect()->route('admin.product_size_color.index')->with('success', 'Dữ liệu đã được cập nhật.');
    }

    public function destroy($id)
    {
        $item = ProductSizeColor::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.product_size_color.index')->with('success', 'Dữ liệu đã được xóa.');
    }
}
