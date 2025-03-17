@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Chỉnh sửa đơn hàng</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mã đơn: {{ $order->orderCode }}</h5>
            <p><strong>Khách hàng:</strong> {{ $order->user->name ?? 'Khách vãng lai' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'Không có email' }}</p>
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
            <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
        </div>
    </div>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mt-4">
            <label for="status" class="form-label"><strong>Trạng thái đơn hàng:</strong></label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã nhận hàng</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </form>
</div>
@endsection
