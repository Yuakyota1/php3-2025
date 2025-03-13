@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Danh sách sản phẩm</h2>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục con</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->subCategory->subcategory_name ?? 'Chưa có danh mục' }}</td> 
                <td>{{ Str::limit($product->description, 50) }}</td>
                <td>
                    @if($product->images)
                        @php
                            $images = json_decode($product->images, true);
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                            @foreach($images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Ảnh sản phẩm" width="50" height="50">
                            @endforeach
                        @endif
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
