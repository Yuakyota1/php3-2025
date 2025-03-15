<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        $postCategories = PostCategory::all(); // Lấy tất cả danh mục
        return view('admin.blog.index', compact('blogs', 'postCategories'));
    }
    

    public function create()
    {
        $postCategories = PostCategory::all();
        return view('admin.blog.create', compact('postCategories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:blogs,title',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published',
            'post_category_id' => 'required|exists:post_categories,id',
        ]);
    
        $imagePath = $request->file('image') ? $request->file('image')->store('blogs', 'public') : null;
    
        Blog::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
            'post_category_id' => $request->post_category_id,
            'author_id' => auth()->id(),
        ]);
    
        return redirect()->route('admin.blog.index')->with('success', 'Bài viết đã được tạo thành công.');
    }
    

    

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:draft,published',
            'post_category_id' => 'required|exists:post_categories,id', // Kiểm tra danh mục hợp lệ
        ]);
    
        if ($request->hasFile('image')) {
            if ($blog->image) Storage::delete('public/' . $blog->image);
            $blog->image = $request->file('image')->store('blogs', 'public');
        }
    
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $blog->image,
            'status' => $request->status,
            'post_category_id' => $request->post_category_id, // Cập nhật danh mục bài viết
        ]);
    
        return redirect()->route('admin.blog.index')->with('success', 'Bài viết đã được cập nhật.');
    }
    

    public function destroy(Blog $blog)
    {
        if ($blog->image) Storage::delete('public/' . $blog->image);
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Bài viết đã bị xóa.');
    }
}
