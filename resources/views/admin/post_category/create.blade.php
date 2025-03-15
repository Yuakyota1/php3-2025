@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Thêm danh mục bài viết</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.post_category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name_postcategory">Tên danh mục:</label>
            <input type="text" name="name_postcategory" class="form-control" value="{{ old('name_postcategory') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
@endsection
