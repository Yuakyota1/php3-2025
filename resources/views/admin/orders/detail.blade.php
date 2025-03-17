@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Chi tiết đơn hàng</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mã đơn: {{ $order->orderCode }}</h5>
            <p><strong>Khách hàng:</strong> {{ $order->user->name ?? 'Khách vãng lai' }}</p>
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
            <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p>
                <strong>Trạng thái:</strong> 
                <span class="badge {{ $order->status == 'paid' ? 'bg-success' : ($order->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>
    </div>

    <h4 class="mt-4">Danh sách sản phẩm</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->product_name ?? 'Sản phẩm đã xóa' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>

        @if ($order->status == 'pending')
            <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-warning">Hủy đơn</button>
            </form>
        @elseif ($order->status == 'canceled')
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</button>
            </form>
        @endif
    </div>
</div>
@endsection
