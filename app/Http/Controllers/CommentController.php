<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        $user = Auth::user();
    
        // Kiểm tra xem user đã bình luận chưa
        $existingComment = Comment::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingComment) {
            return back()->with('error', 'Bạn chỉ có thể bình luận một lần. Hãy xóa bình luận cũ để gửi lại.');
        }
    
        // Kiểm tra xem user đã mua sản phẩm chưa
        $hasPurchased = Order::where('user_id', $user->id)
            ->whereHas('orderItems', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->exists();
    
        if (!$hasPurchased) {
            return back()->with('error', 'Bạn phải mua sản phẩm này trước khi bình luận.');
        }
    
        // Xử lý upload ảnh
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('comments', 'public');
        }
    
        // Lưu bình luận vào database
        Comment::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'image' => $imagePath,
            'rating' => $request->rating,
        ]);
    
        return back()->with('success', 'Bình luận đã được đăng!');
    }
    

    
    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }
    
        // Xóa ảnh nếu có
        if ($comment->image) {
            Storage::disk('public')->delete($comment->image);
        }
    
        $comment->delete();
        return back()->with('success', 'Bình luận đã bị xóa.');
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // Kiểm tra quyền sửa bình luận
        if (auth()->id() !== $comment->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn không có quyền sửa bình luận này!'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'comment' => $comment
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        $comment = Comment::findOrFail($id);

        // Kiểm tra quyền sửa bình luận
        if (auth()->id() !== $comment->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn không có quyền sửa bình luận này!'
            ], 403);
        }

        // Cập nhật nội dung bình luận
        $comment->content = $request->content;

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($comment->image) {
                Storage::disk('public')->delete($comment->image);
            }
            // Lưu ảnh mới
            $comment->image = $request->file('image')->store('comments', 'public');
        }

        $comment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Bình luận đã được cập nhật!',
            'comment' => $comment
        ]);
    }
}
