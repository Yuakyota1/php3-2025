<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // Hiển thị danh sách subcategory
    public function index()
    {
        $subcategories = SubCategory::with('category')->get(); // Lấy tất cả subcategory và danh mục cha
        return view('admin.subcategory.index', compact('subcategories'));
    }

    // Hiển thị form tạo subcategory
    public function create()
    {
        $categories = Category::all(); // Lấy danh mục cha để chọn
        return view('admin.subcategory.create', compact('categories'));
    }

    // Lưu subcategory vào database
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|string|max:255|unique:sub_categories',
            'category_id' => 'required|exists:categories,id',
        ]);

        SubCategory::create([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.subcategory.index')->with('success', 'Danh mục con đã được tạo.');
    }
    public function edit($id)
{
    $subcategory = SubCategory::findOrFail($id);
    $categories = Category::all();
    return view('admin.subcategory.edit', compact('subcategory', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'subcategory_name' => 'required|string|max:255|unique:sub_categories,subcategory_name,'.$id,
        'category_id' => 'required|exists:categories,id',
    ]);

    $subcategory = SubCategory::findOrFail($id);
    $subcategory->update([
        'subcategory_name' => $request->subcategory_name,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('admin.subcategory.index')->with('success', 'Danh mục con đã được cập nhật.');
}

public function destroy($id)
{
    SubCategory::findOrFail($id)->delete();
    return redirect()->route('admin.subcategory.index')->with('success', 'Danh mục con đã được xóa.');
}

}
