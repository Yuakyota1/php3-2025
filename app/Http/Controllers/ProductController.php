<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::paginate(2); // Hiển thị 10 sản phẩm mỗi trang
        return view('admin.product.index', compact('products'));
    }
    

    public function shop()
    {
        $products = Product::paginate(12); // Hiển thị 12 sản phẩm mỗi trang
        return view('product.index', compact('products'));
    }
    public function show($id) {
        $product = Product::with(['sizeColors', 'subCategory', 'comments.user'])->findOrFail($id);
        return view('product.detail', compact('product'));
    }
    
    
    // Hiển thị form tạo sản phẩm
    public function create()
    {
        $subCategories = SubCategory::all(); 
        return view('admin.product.create', compact('subCategories'));
    }
    

    
    public function store(Request $request)
    {
        $request->validate([
            'product_name'    => 'required|string|max:255',
            'description'     => 'nullable|string',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'images'          => 'required|array',
            'images.*'        => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048' 
        ], [
            'product_name.required'    => 'Vui lòng nhập tên sản phẩm.',
            'product_name.max'         => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'description.string'       => 'Mô tả sản phẩm phải là chuỗi văn bản.',
            'sub_category_id.required' => 'Vui lòng chọn danh mục con.',
            'sub_category_id.exists'   => 'Danh mục con không hợp lệ.',                                                                                                                            
            'images.required'          => 'Vui lòng tải lên ít nhất một hình ảnh.',
            'images.array'             => 'Hình ảnh phải được gửi dưới dạng danh sách.',
            'images.*.image'           => 'Tập tin phải là hình ảnh.',
            'images.*.mimes'           => 'Ảnh phải có định dạng: jpeg, png, jpg, webp, gif.',
            'images.*.max'             => 'Dung lượng ảnh không được vượt quá 2MB.',
        ]);
    
        try {
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('products', 'public'); 
                }
            }
    
            Product::create([
                'product_name'    => $request->product_name,
                'description'     => $request->description,
                'sub_category_id' => $request->sub_category_id,
                'images'          => json_encode($imagePaths),
            ]);
    
            return redirect()->route('admin.product.create')->with('success', 'Sản phẩm đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.create')->with('error', 'Thêm sản phẩm thất bại! Vui lòng thử lại.');
        }
    }
    
    // Hiển thị form sửa sản phẩm
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all(); 
        
        return view('admin.product.edit', compact('product', 'subCategories'));
    }
    

    // Xử lý cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        // Validate dữ liệu
        $request->validate([
            'product_name' => 'required|string|max:255',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp,gif,svg|max:2048'
        ]);
    
        // Xử lý xóa ảnh cũ nếu có
        $images = json_decode($product->images, true) ?? [];
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $deleteImage) {
                if (($key = array_search($deleteImage, $images)) !== false) {
                    unset($images[$key]);
                    Storage::delete('public/' . $deleteImage);
                }
            }
        }
    
        // Xử lý upload ảnh mới
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/products', 'public');
                $images[] = $path;
            }
        }
    
        // Cập nhật sản phẩm
        $product->update([
            'product_name' => $request->product_name,
            'sub_category_id' => $request->sub_category_id,
            'description' => $request->description,
            'images' => json_encode(array_values($images))
        ]);
    
        return redirect()->route('admin.product.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }
    

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
    
        if ($product) {
            $product->delete();
            return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa.']);
        }
    
        return response()->json(['success' => false, 'message' => 'Xóa sản phẩm thất bại.']);
    }
    
    
}
