<h2>Xin chào {{ $order->name }},</h2>
<p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi. Đây là thông tin đơn hàng của bạn:</p>
<ul>
    <li><strong>Mã đơn hàng:</strong> {{ $order->orderCode }}</li>
    <li><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }} VND</li>
    <li><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</li>
</ul>
<p>Chúng tôi sẽ sớm xử lý đơn hàng của bạn.</p>
<p>Xin cảm ơn!</p>
