<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Hiển thị danh sách banners
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    // Hiển thị form tạo banner
    public function create()
    {
        return view('admin.banner.create');
    }

    // Xử lý thêm banner
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
        ]);

        try {
            $imagePath = $request->file('image')->store('banners', 'public');

            Banner::create([
                'title' => $request->title,
                'image' => $imagePath,
                'link' => $request->link,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.banner.index')->with('success', 'Banner đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.create')->with('error', 'Thêm banner thất bại! Vui lòng thử lại.');
        }
    }

    // Hiển thị form sửa banner
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    // Xử lý cập nhật banner
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'link' => 'nullable|url',
            'status' => 'required|boolean',
        ]);

        try {
            // Xóa ảnh cũ nếu có ảnh mới
            if ($request->hasFile('image')) {
                Storage::delete('public/' . $banner->image);
                $imagePath = $request->file('image')->store('banners', 'public');
                $banner->update(['image' => $imagePath]);
            }

            $banner->update($request->except('image'));

            return redirect()->route('admin.banner.index')->with('success', 'Banner đã được cập nhật.');
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.edit', $banner->id)->with('error', 'Cập nhật banner thất bại! Vui lòng thử lại.');
        }
    }

    // Xóa banner
    public function destroy(Banner $banner)
    {
        try {
            Storage::delete('public/' . $banner->image);
            $banner->delete();

            return redirect()->route('admin.banner.index')->with('success', 'Banner đã được xóa.');
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.index')->with('error', 'Xóa banner thất bại! Vui lòng thử lại.');
        }
    }
}
