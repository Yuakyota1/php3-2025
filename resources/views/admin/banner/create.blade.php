@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Thêm Banner Mới</h2>

    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hiển thị</option>
                <option value="0">Ẩn</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Thêm Banner</button>
        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
