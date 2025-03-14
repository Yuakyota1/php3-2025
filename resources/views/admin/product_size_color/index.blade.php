@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Danh Sách Màu Sắc & Kích Thước Sản Phẩm</h2>
    <a href="{{ route('admin.product_size_color.create') }}" class="btn btn-primary mb-3">Thêm Mới</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Màu sắc</th>
                <th>Kích thước</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->product->product_name }}</td>
                <td>{{ $item->color }}</td>
                <td>{{ $item->size->size_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }} VNĐ</td>
                <td>
                    <a href="{{ route('admin.product_size_color.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.product_size_color.destroy', $item->id) }}" method="POST" style="display:inline;">
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
