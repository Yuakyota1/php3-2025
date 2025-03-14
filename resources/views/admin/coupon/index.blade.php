@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-3">Danh sách mã giảm giá</h2>
    <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary mb-3">Thêm Mới</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã Coupon</th>
                <th>Loại</th>
                <th>Giá trị giảm</th>
                <th>Giới hạn sử dụng</th>
                <th>Đã sử dụng</th>
                <th>Ngày hết hạn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $key => $coupon)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->type == 'percentage' ? 'Giảm %' : 'Giảm tiền' }}</td>
                <td>{{ number_format($coupon->discount, 2) }} {{ $coupon->type == 'percentage' ? '%' : 'VNĐ' }}</td>
                <td>{{ $coupon->usage_limit ?? 'Không giới hạn' }}</td>
                <td>{{ $coupon->used_count }}</td>
                <td>{{ $coupon->expiry_date }}</td>
                <td>{{ $coupon->status ? 'Hoạt động' : 'Dừng' }}</td>
                <td>
                    <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa mã giảm giá này?')">Xóa</button>
                    </form>
                </button>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
