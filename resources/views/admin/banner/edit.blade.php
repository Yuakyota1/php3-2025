@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Chỉnh sửa Banner</h2>

    <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $banner->title }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh hiện tại</label><br>
            <img src="{{ asset('storage/' . $banner->image) }}" width="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Thay đổi hình ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control" value="{{ $banner->link }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $banner->status ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ !$banner->status ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
