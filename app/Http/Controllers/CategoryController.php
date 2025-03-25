<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục
    public function create()
    {
        return view('admin.category.create');
    }

    // Xử lý thêm danh mục
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => [
                'required',
                'string',
                'max:255',
                'unique:categories',
                'regex:/^[\p{L}0-9\s*]+$/u'
                // Chỉ cho phép chữ cái, số và khoảng trắng
            ],
        ], [
            'category_name.required' => 'Tên danh mục không được để trống.',
            'category_name.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'category_name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'category_name.unique' => 'Danh mục này đã tồn tại.',
            'category_name.regex' => 'Tên danh mục chỉ được chứa chữ cái, số và khoảng trắng.',
        ]);

        Category::create(['category_name' => $request->category_name]);

        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được tạo.');
    }


    // Hiển thị form sửa danh mục
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    // Xử lý cập nhật danh mục
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update(['category_name' => $request->category_name]);

        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được cập nhật.');
    }

    // Xóa danh mục
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['success' => true, 'message' => 'Danh mục đã được xóa.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Xóa danh mục thất bại!']);
        }
    }
}
