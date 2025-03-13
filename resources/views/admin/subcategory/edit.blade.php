@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Chỉnh sửa danh mục con</h2>
    <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="subcategory_name">Tên danh mục con</label>
            <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategory->subcategory_name }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục cha</label>
            <select class="form-control" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
