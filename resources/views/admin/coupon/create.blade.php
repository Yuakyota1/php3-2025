@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Thêm Mã Giảm Giá Mới</h2>

    <form action="{{ route('admin.coupon.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Mã Coupon</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại Giảm Giá</label>
            <select name="type" class="form-control" required>
                <option value="percentage">Giảm theo %</option>
                <option value="fixed">Giảm theo số tiền</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá trị giảm</label>
            <input type="number" name="discount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới hạn số lần dùng</label>
            <input type="number" name="usage_limit" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày hết hạn</label>
            <input type="date" name="expiry_date" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hoạt động</option>
                <option value="0">Ngừng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Thêm mới</button>
    </form>
</div>
@endsection
