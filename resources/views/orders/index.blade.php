@include('layout.head')
@include('layout.header')

<div class="container py-4">
    <h4 class="mb-4 text-primary"><i class="bi bi-bag-check"></i> Đơn hàng của bạn</h4>
    <form action="{{ route('orders.index') }}" method="GET" class="mb-4 row g-3 align-items-center">
    <div class="col-md-4">
        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Tìm mã đơn hoặc tên đơn hàng...">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">-- Tất cả trạng thái --</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ</option>
            <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Tìm kiếm</button>
    </div>
</form>
    @foreach($orders as $order)
   

    <div class="card mb-4 shadow-sm border rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <div class="text-muted">
                Mã đơn: <strong>#{{ $order->orderCode }}</strong>
            </div>
            <div>
                <span class="badge {{ $order->status == 'paid' ? 'bg-success' : ($order->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="mb-2"><i class="bi bi-calendar-event me-2"></i>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p class="mb-2"><i class="bi bi-credit-card me-2"></i>Thanh toán: <span class="text-uppercase">{{ $order->payment_method }}</span></p>
                </div>
                <div class="col-md-4 text-end">
                    <p class="mb-2 fw-bold text-danger">Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
                </div>
            </div>

            <div class="mt-3 text-end">
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="bi bi-eye"></i> Xem chi tiết
                </a>

                @if ($order->status == 'pending')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-x-circle"></i> Hủy đơn
                    </button>
                </form>
                @elseif (in_array($order->status, ['canceled', 'failed']))
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                        <i class="bi bi-trash"></i> Xóa đơn
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>

@include('layout.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@if(session('success'))
<script>
    Swal.fire({
        title: 'Thành công!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        title: 'Lỗi!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif
<style>
    .card:hover {
        box-shadow: none !important;
        transform: none !important;
        transition: none !important;
    }
</style>
<style>
    .card:hover {
        box-shadow: none !important;
        transform: none !important;
        transition: none !important;
    }

    .card-body,
    .card-header,
    .card-body p,
    .btn,
    .badge {
        font-size: 1.55rem; /* Tăng nhẹ cỡ chữ toàn bộ nội dung đơn */
    }

    h4 {
        font-size: 1.5rem;
    }

    .fw-bold {
        font-size: 1.1rem;
    }
</style>
