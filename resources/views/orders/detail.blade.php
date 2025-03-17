@include('layout.head')
@include('layout.header')

<div class="container">
    <h2 class="mb-4">Chi tiết đơn hàng: {{ $order->orderCode }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Trạng thái:</strong> 
                <span class="badge {{ $order->status == 'paid' ? 'bg-success' : ($order->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>
    </div>

    <h3 class="mb-3">Danh sách sản phẩm</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Size</th>
                <th>Màu sắc</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
    @if(!empty($order->items) && count($order->items) > 0)
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->product_name ?? 'Sản phẩm không tồn tại' }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->color }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                <td>{{ number_format($item->total, 0, ',', '.') }}đ</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">Không có sản phẩm nào trong đơn hàng.</td>
        </tr>
    @endif
</tbody>

    </table>

    <div class="text-end mt-3">
        <h4>Tổng tiền đơn hàng: {{ number_format($order->total_price, 0, ',', '.') }}đ</h4>
    </div>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
</div>


@include('layout.footer')
