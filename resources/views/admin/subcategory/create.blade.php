@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Thêm danh mục con</h2>
    <form action="{{ route('admin.subcategory.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subcategory_name">Tên danh mục con</label>
            <input type="text" class="form-control" name="subcategory_name" required>
        </div>

        <div class="form-group">
            <label for="category_id">Chọn danh mục cha</label>
            <select class="form-control" name="category_id" required>
                <option value="">-- Chọn danh mục cha --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
