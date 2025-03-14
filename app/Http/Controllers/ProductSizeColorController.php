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

        ProductSizeColor::create($request->only(['idProduct', 'color', 'idSize', 'quantity', 'price']));

        return redirect()->route('admin.product_size_color.index')->with('success', 'Dữ liệu đã được thêm.');
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
