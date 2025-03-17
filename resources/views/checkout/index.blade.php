@include('layout.head')
@include('layout.header')

<div class="container py-5">
    <h2 class="mb-4 text-center">🛍️ Thanh toán</h2>

    <div class="row">
        <!-- Giỏ hàng -->
        <div class="col-lg-7">
            <div class="card shadow p-4 mb-4">
                <h4 class="mb-3">🛒 Giỏ hàng của bạn</h4>
                <table class="table table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>STT</th>
                            <th>Size</th>
                            <th>Màu</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach ($carts as $index => $cart)
                            <?php $itemTotal = $cart['price'] * $cart['quantity']; $total += $itemTotal; ?>
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cart['size'] }}</td>
                                <td>{{ $cart['color'] }}</td>
                                <td><img src="{{ $cart['image'] }}" width="75" height="50"></td>
                                <td>{{ $cart['quantity'] }}</td>
                                <td>{{ number_format($cart['price']) }} VND</td>
                                <td>{{ number_format($itemTotal) }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Thông tin thanh toán -->
        <div class="col-lg-5">
            <div class="card shadow p-4">
                <h4 class="mb-3">📝 Thông tin đặt hàng</h4>
                <form action="/checkout" method="POST">
                    @csrf
                    <input type="hidden" name="discount_amount" value="0">
                    <div class="mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phương thức thanh toán</label>
                        <select name="payment" class="form-control" required>
                            <option value="cod">Thanh toán khi nhận hàng</option>
                            <option value="vnpay">VNPAY</option>
                            <option value="momo">MOMO</option>
                            <option value="zalopay">ZALO PAY</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">✅ Đặt hàng</button>
                        <a href="/carts" class="btn btn-secondary w-100 mt-2">🔙 Quay lại giỏ hàng</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<!-- AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#apply_coupon").click(function() {
        let couponCode = $("#coupon_code").val().trim();
        if (couponCode === "") {
            $("#coupon_message").text("Vui lòng nhập mã giảm giá.");
            return;
        }

        $.ajax({
            url: "/cart/apply-coupon",
            type: "POST",
            data: { coupon_code: couponCode },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    let currentTotal = <?= $total ?>;
                    let shippingFee = <?= $shippingFee ?>;
                    let discountAmount = Math.floor((response.discount_percent / 100) * currentTotal);
                    let newTotal = Math.max(0, currentTotal + shippingFee - discountAmount);

                    // Cập nhật giao diện
                    $("#coupon_message").html(`<span class="text-success">Áp dụng thành công! Giảm ${response.discount_percent}%</span>`);
                    $("#discount_hidden").val(discountAmount); // Cập nhật input ẩn
                    $("#total_payable").html(`<strong>${newTotal.toLocaleString()} VND</strong>`);

                    // Thêm thông tin giảm giá vào giao diện
                    $("#discount_amount").remove();
                    $(".checkout-summary").append(`<h4 id="discount_amount" style="color: red;">Coupon Discount: -${discountAmount.toLocaleString()} VND</h4>`);
                } else {
                    $("#coupon_message").html(`<span class="text-danger">${response.message}</span>`);
                }
            },
            error: function() {
                $("#coupon_message").html(`<span class="text-danger">Có lỗi xảy ra, vui lòng thử lại!</span>`);
            }
        });
    });
});
</script>
