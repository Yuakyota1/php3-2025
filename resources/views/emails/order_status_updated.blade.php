<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật trạng thái đơn hàng</title>
</head>
<body>
    <h3>Xin chào {{ $order->user->name ?? 'Quý khách' }},</h3>
    <p>Đơn hàng <strong>{{ $order->orderCode }}</strong> của bạn đã được cập nhật trạng thái:</p>
    <p><strong>Trạng thái mới:</strong> {{ ucfirst($order->status) }}</p>
    <p>Chi tiết đơn hàng có thể được xem tại trang quản lý đơn hàng của bạn.</p>
    <p>Cảm ơn bạn đã mua hàng!</p>
</body>
</html>
