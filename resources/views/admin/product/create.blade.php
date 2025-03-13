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
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>

        <!-- Danh mục con -->
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">Danh mục con</label>
            <select class="form-control" id="sub_category_id" name="sub_category_id" required>
                <option value="">Chọn danh mục con</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->subcategory_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <!-- Ảnh sản phẩm -->
        <div class="mb-3">
            <label for="images" class="form-label">Hình ảnh sản phẩm</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

</div>
@endsection
