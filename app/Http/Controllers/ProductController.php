<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\SubCategory;
use  App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::paginate(10); 
        return view('admin.product.index', compact('products'));
    }
    

    public function shop(Request $request)
    {
        $query = Product::query();
    
        // Lọc theo danh mục cha
        if ($request->has('category') && !empty($request->category)) {
            $query->whereIn('category_id', (array) $request->category);
        }
    
        // Lọc theo danh mục con
        if ($request->has('subcategory') && !empty($request->subcategory)) {
            $query->whereIn('sub_category_id', (array) $request->subcategory);
        }
    
        $products = $query->paginate(6);
        $categories = Category::with('subcategories')->get();
    
        return view('product.index', compact('products', 'categories'));
    }
    
    
    public function show($id) {
        $product = Product::with(['sizeColors', 'subCategory', 'comments.user'])->findOrFail($id);
        return view('product.detail', compact('product'));
    }
    
    
    // Hiển thị form tạo sản phẩm
    public function create()
    {
        $subCategories = SubCategory::all(); 
        $brands = Brand::all(); // Lấy danh sách thương hiệu
        return view('admin.product.create', compact('subCategories', 'brands'));
    }
    
    

    public function store(Request $request)
{
    $request->validate([
        'product_name'    => 'required|string|max:255',
        'description'     => 'nullable|string',
        'category_id'     => 'required|exists:categories,id', // Thêm validation cho category_id
        'sub_category_id' => 'required|exists:sub_categories,id',
        'brand_id'        => 'nullable|exists:brands,id',
        'images'          => 'required|array',
        'images.*'        => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048' 
    ], [
        'category_id.required' => 'Vui lòng chọn danh mục cha.',
        'category_id.exists'   => 'Danh mục cha không hợp lệ.',
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
            'category_id'     => $request->category_id, // Lưu category_id
            'sub_category_id' => $request->sub_category_id,
            'brand_id'        => $request->brand_id,
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
        $brands = Brand::all(); // Lấy danh sách thương hiệu
        return view('admin.product.edit', compact('product', 'subCategories', 'brands'));
    }
    
    

    // Xử lý cập nhật sản phẩm
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'product_name'    => 'required|string|max:255',
        'category_id'     => 'required|exists:categories,id', // Thêm validation cho category_id
        'sub_category_id' => 'required|exists:sub_categories,id',
        'brand_id'        => 'nullable|exists:brands,id',
        'description'     => 'nullable|string',
        'images.*'        => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048'
    ]);

    $images = json_decode($product->images, true) ?? [];
    
    if ($request->has('delete_images')) {
        foreach ($request->delete_images as $deleteImage) {
            if (($key = array_search($deleteImage, $images)) !== false) {
                unset($images[$key]);
                Storage::delete('public/' . $deleteImage);
            }
        }
    }

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('uploads/products', 'public');
            $images[] = $path;
        }
    }

    $product->update([
        'product_name'    => $request->product_name,
        'category_id'     => $request->category_id, // Cập nhật category_id
        'sub_category_id' => $request->sub_category_id,
        'brand_id'        => $request->brand_id,
        'description'     => $request->description,
        'images'          => json_encode(array_values($images))
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
