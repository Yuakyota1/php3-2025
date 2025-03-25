@extends('admin.layout')

@section('content')
    <div class="container">
        <h2>Thêm danh mục mới</h2>



        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_name">Tên danh mục</label>
                <input type="text" id="category_name" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') }}" >
                
                @error('category_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
