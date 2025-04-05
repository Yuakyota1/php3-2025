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
        <div class="form-group">
  
        <!-- Tên sản phẩm -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control @error('product_name') is-invalid @enderror" 
                   id="product_name" name="product_name" value="{{ old('product_name') }}" >
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
    <label for="category_id">Danh mục cha</label>
    <select name="category_id" id="category_id" class="form-control">
        <option value="">Chọn danh mục</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="sub_category_id">Danh mục con</label>
    <select name="sub_category_id" id="sub_category_id" class="form-control">
        <option value="">Chọn danh mục con</option>
    </select>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var category_id = $(this).val();
            $('#sub_category_id').html('<option value="">Chọn danh mục con</option>'); // Reset danh mục con

            if (category_id) {
                $.ajax({
                    url: '/get-subcategories/' + category_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#sub_category_id').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
