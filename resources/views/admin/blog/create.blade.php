@extends('admin.layout')
@section('content')
<div class="container">
    <h2>Thêm bài viết</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="post_category_id">Danh mục</label>
    <select name="post_category_id" class="form-control" required>
        <option value="">Chọn danh mục</option>
        @foreach($postCategories as $category)
            <option value="{{ $category->id }}">{{ $category->name_postcategory }}</option>
        @endforeach
    </select>
        <div class="mb-3">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công khai</option>
            </select>
        </div>

        @csrf
        <button type="submit" class="btn btn-success">Tạo bài viết</button>
    </form>
</div>
@endsection
