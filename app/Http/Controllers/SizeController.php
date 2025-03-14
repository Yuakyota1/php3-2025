<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    // Hiển thị danh sách kích thước
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }

    // Hiển thị form tạo kích thước
    public function create()
    {
        return view('admin.size.create');
    }

    // Xử lý thêm kích thước
    public function store(Request $request)
    {
        $request->validate([
            'size_name' => 'required|string|max:255|unique:sizes',
        ]);

        Size::create(['size_name' => $request->size_name]);

        return redirect()->route('admin.size.index')->with('success', 'Kích thước đã được tạo.');
    }

    // Hiển thị form sửa kích thước
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.size.edit', compact('size'));
    }

    // Xử lý cập nhật kích thước
    public function update(Request $request, $id)
    {
        $request->validate([
            'size_name' => 'required|string|max:255|unique:sizes,size_name,' . $id,
        ]);

        $size = Size::findOrFail($id);
        $size->update(['size_name' => $request->size_name]);

        return redirect()->route('admin.size.index')->with('success', 'Kích thước đã được cập nhật.');
    }

    // Xóa kích thước
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect()->route('admin.size.index')->with('success', 'Kích thước đã được xóa.');
    }
}
