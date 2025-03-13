@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Chỉnh sửa sản phẩm</h2>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Tên sản phẩm -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
        </div>

        <!-- Danh mục con -->
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">Danh mục con</label>
            <select class="form-control" id="sub_category_id" name="sub_category_id" required>
    <option value="">Chọn danh mục con</option>
    @foreach ($subCategories as $subCategory)
        <option value="{{ $subCategory->id }}" {{ $product->sub_category_id == $subCategory->id ? 'selected' : '' }}>
            {{ $subCategory->subcategory_name }}
        </option>
    @endforeach
</select>

        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
        </div>

       <!-- Ảnh sản phẩm -->
<div class="mb-3">
    <label for="images" class="form-label">Hình ảnh sản phẩm</label>
    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">

    <div class="mt-2">
        <label>Ảnh hiện tại:</label>
        <div class="d-flex flex-wrap">
            @foreach (json_decode($product->images, true) as $image)
                <div class="m-2 text-center">
                    <img src="{{ asset('storage/' . $image) }}" alt="Hình ảnh" width="100" height="100">
                    <br>
                    <input type="checkbox" name="delete_images[]" value="{{ $image }}"> Xóa ảnh
                </div>
            @endforeach
        </div>
    </div>
</div>


        <!-- Nút Submit -->
        <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
