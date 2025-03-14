@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Thêm Màu Sắc & Kích Thước Sản Phẩm</h2>
    <form action="{{ route('admin.product_size_color.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="idProduct" class="form-label">Sản phẩm</label>
            <select name="idProduct" id="idProduct" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Màu sắc</label>
            <input type="text" name="color" id="color" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idSize" class="form-label">Kích thước</label>
            <select name="idSize" id="idSize" class="form-control" required>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Số lượng</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection
