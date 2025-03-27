<?php
namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // Hiển thị danh sách thương hiệu
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    // Hiển thị form tạo thương hiệu mới
    public function create()
    {
        return view('admin.brands.create');
    }

    // Lưu thông tin thương hiệu mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Brand::create($request->all());

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully');
    }

    // Hiển thị thông tin thương hiệu
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.show', compact('brand'));
    }

    // Hiển thị form chỉnh sửa thương hiệu
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    // Cập nhật thông tin thương hiệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully');
    }

    // Xóa thương hiệu
    public function destroy($id)
    {
        try {
            $brand = brand::findOrFail($id);
            $brand->delete();

            return response()->json(['success' => true, 'message' => 'Danh mục đã được xóa.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Xóa danh mục thất bại!']);
        }
    }
}
