@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Chỉnh sửa Mã Giảm Giá</h2>
    <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mã Coupon</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại Giảm Giá</label>
            <select name="type" class="form-control" required>
                <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>Phần trăm</option>
                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Cố định</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá trị giảm</label>
            <input type="number" name="discount" class="form-control" value="{{ $coupon->discount }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày hết hạn</label>
            <input type="date" name="expiry_date" class="form-control" value="{{ $coupon->expiry_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
@endsection
