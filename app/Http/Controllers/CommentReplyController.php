<?php

namespace App\Http\Controllers;

use App\Models\CommentReply;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CommentReplyController extends Controller
{
    // Lưu phản hồi (giữ nguyên)
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'nullable|exists:comments,id',
            'parent_reply_id' => 'nullable|exists:comment_replies,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        $reply = new CommentReply();
        $reply->user_id = auth()->id();

        if ($request->comment_id) {
            $reply->comment_id = $request->comment_id;
        } elseif ($request->parent_reply_id) {
            $reply->parent_reply_id = $request->parent_reply_id;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Bình luận gốc hoặc phản hồi cha không hợp lệ'
            ], 400);
        }

        $reply->content = $request->content;

        if ($request->hasFile('image')) {
            $reply->image = $request->file('image')->store('comment_replies', 'public');
        }

        $reply->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Phản hồi đã được thêm!',
            'reply' => $reply
        ]);
    }

    // Xóa phản hồi
    public function destroy($id)
    {
        $reply = CommentReply::findOrFail($id);

        if (auth()->id() !== $reply->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn không có quyền xóa phản hồi này!'
            ], 403);
        }

        if ($reply->image) {
            Storage::disk('public')->delete($reply->image);
        }

        $reply->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Phản hồi đã được xóa!'
        ]);
    }

    // Sửa phản hồi
    public function edit($id)
    {
        $reply = CommentReply::findOrFail($id);

        if (auth()->id() !== $reply->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn không có quyền sửa phản hồi này!'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'reply' => $reply
        ]);
    }

    // Cập nhật phản hồi
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
        ]);

        $reply = CommentReply::findOrFail($id);

        if (auth()->id() !== $reply->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn không có quyền sửa phản hồi này!'
            ], 403);
        }

        $reply->content = $request->content;

        if ($request->hasFile('image')) {
            if ($reply->image) {
                Storage::disk('public')->delete($reply->image);
            }
            $reply->image = $request->file('image')->store('comment_replies', 'public');
        }

        $reply->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Phản hồi đã được cập nhật!',
            'reply' => $reply
        ]);
    }
}