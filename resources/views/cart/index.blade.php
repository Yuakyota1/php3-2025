@include('layout.head')
@include('layout.header')

<div class="container py-4">
    <h2 class="mb-4 text-center">🛒 Giỏ hàng của bạn</h2>

    <div class="clearfix"></div> <!-- Đẩy nội dung xuống -->

    @if (empty($carts) || (is_object($carts) && $carts->isEmpty()))
    <div class="d-flex justify-content-center mt-4">
        <div class="text-center">
            Giỏ hàng trống. <br>
            <a href="{{ url('/product') }}" class="btn btn-primary mt-2">🛍️ Tiếp tục mua sắm</a>
        </div>
    </div>
    @else

    <div class="table-responsive mt-4"> <!-- Thêm khoảng cách -->
        <table class="table align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Kích thước</th>
                    <th>Màu sắc</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng cộng</th>
                    <th>❌</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td><img src="{{ is_array($cart) ? $cart['image'] : $cart->image }}" width="60"></td>
                    <td>{{ is_array($cart) ? $cart['name'] : $cart->name }}</td>
                    <td>{{ is_array($cart) ? ($cart['size'] ?? 'Không có') : $cart->size }}</td>
                    <td>{{ is_array($cart) ? $cart['color'] : $cart->color }}</td>
                    <td>
                        @if(Auth::check())
                        <form action="{{ route('cart.update', $cart->id ) }}" method="POST" class="d-flex flex-column align-items-center">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ is_array($cart) ? $cart['quantity'] : $cart->quantity }}"
                                min="1" max="{{ is_array($cart) ? $cart['max_quantity'] : $cart->max_quantity }}"
                                class="form-control w-50">

                            @if(session('error_'.$cart->id))
                            <small class="text-danger mt-1">{{ session('error_'.$cart->id) }}</small>
                            @endif

                            <button type="submit" class="btn btn-outline-primary btn-sm mt-2">cập nhật</button>
                        </form>
                        @else
                        <span>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để cập nhật số lượng</span>
                        @endif
                    </td>
                    <td>{{ number_format(is_array($cart) ? $cart['price'] : $cart->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format(is_array($cart) ? $cart['total_price'] : $cart->total_price, 0, ',', '.') }} VND</td>
                    <td>
                        @if (!is_array($cart))
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">❌</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ url('/') }}" class="btn btn-secondary">🛍️ Tiếp tục mua sắm</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-success">💳 Thanh toán</a>
    </div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form[action*='cart/update']").forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Ngăn form reload trang

            let formData = new FormData(this);
            let actionUrl = this.getAttribute("action");

            fetch(actionUrl, {
                method: "POST", // Nếu route dùng POST thì giữ nguyên
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: data.status === "success" ? "success" : "error",
                    title: data.status === "success" ? "Thành công!" : "Lỗi!",
                    text: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });

                if (data.status === "success") {
                    setTimeout(() => location.reload(), 2000);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi!",
                    text: "Đã xảy ra lỗi không mong muốn.",
                    showConfirmButton: true
                });
            });
        });
    });
});

</script>

@include('layout.footer')
