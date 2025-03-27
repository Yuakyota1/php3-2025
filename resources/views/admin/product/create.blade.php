@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Thêm sản phẩm mới</h2>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên sản phẩm -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" 
                   id="product_name" name="product_name" value="{{ old('product_name') }}" >
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Danh mục con -->
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">Danh mục con</label>
            <select class="form-control @error('sub_category_id') is-invalid @enderror" 
                    id="sub_category_id" name="sub_category_id" >
                <option value="">Chọn danh mục con</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}" 
                        {{ old('sub_category_id') == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->subcategory_name }}</option>
                @endforeach
            </select>
            @error('sub_category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Thương hiệu -->
        <div class="mb-3">
            <label for="brand_id" class="form-label">Thương hiệu</label>
            <select class="form-control @error('brand_id') is-invalid @enderror" 
                    id="brand_id" name="brand_id" >
                <option value="">Chọn thương hiệu</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" 
                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Ảnh sản phẩm -->
        <div class="mb-3">
            <label for="images" class="form-label">Hình ảnh sản phẩm</label>
            <input type="file" class="form-control @error('images') is-invalid @enderror" 
                   id="images" name="images[]" multiple accept="image/*">
            @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('images.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

</div>
@endsection
