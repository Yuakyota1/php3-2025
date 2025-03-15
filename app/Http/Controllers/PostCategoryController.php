<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        $categories = PostCategory::latest()->paginate(10);
        return view('admin.post_category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.post_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_postcategory' => 'required|string|max:255|unique:post_categories,name_postcategory',
        ]);
    
        PostCategory::create([
            'name_postcategory' => $request->name_postcategory,
            'slug' => \Str::slug($request->name_postcategory),
        ]);
    
        return redirect()->route('admin.post_category.index')->with('success', 'Danh mục bài viết đã được thêm thành công.');
    }
    
}
