@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Chỉnh sửa danh mục</h2>
    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Tên danh mục:</label>
            <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
