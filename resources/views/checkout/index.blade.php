@include('layout.head')
@include('layout.header')

<html>
 <head>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <style>





.flex-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.section-wrapper {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
}

.left-column, .right-column {
    width: 48%;
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding: 20px;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
}

.form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background-color: #218838;
}

.cart-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 15px;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
}

.cart-item img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
}

.text-right {
    text-align: right;
    font-weight: bold;
}

 </style>
 <body class="bg-gray">
  <div class="container">
   <div class="flex-container">
    <!-- Left Column -->
    <div class="left-column">
     <h1>Thanh toán</h1>
     <h2>1. Địa chỉ giao hàng</h2>
     <form action="/checkout" method="POST">
      @csrf
      <div class="form-group" style="margin-bottom: 20px;">
       <label for="email">Địa chỉ email *</label>
       <input name="email" id="email" placeholder="example@gmail.com" type="email" required/>
      </div>
      <div class="form-group" style="margin-bottom: 20px;">
       <label for="name">Họ và Tên *</label>
       <input name="name" id="name" placeholder="Họ và Tên" type="text" required/>
      </div>
      <div class="form-group" style="margin-bottom: 20px;">
       <label for="phone">Số điện thoại *</label>
       <input name="phone" id="phone" placeholder="Số điện thoại" type="text" required/>
      </div>
      <div class="form-group" style="margin-bottom: 20px;">
       <label for="address">Địa chỉ cụ thể *</label>
       <input name="address" id="address" placeholder="Địa chỉ cụ thể" type="text" required/>
      </div>
      <h2>2. Phương thức thanh toán</h2>
      <div class="form-group" style="margin-bottom: 20px;">
       <label>
        <input name="payment" type="radio" value="cod" required/>
        Thanh toán khi nhận hàng
       </label>
      </div>
      <div class="form-group" style="margin-bottom: 20px;">
       <label>
        <input name="payment" type="radio" value="vnpay" required/>
        Thanh toán qua VNPAY
       </label>
      </div>
      <h2>3. Áp dụng mã giảm giá</h2>
      <div class="form-group" style="margin-bottom: 20px;">
       <input id="coupon_code" placeholder="Nhập mã giảm giá" type="text"/>
       <button id="apply_coupon">Sử dụng</button>
      </div>
      
      <input type="hidden" name="discount_amount" id="discount_amount" value="0">
      <div class="text-center" style="margin-top: 30px;">
       <button type="submit">ĐẶT HÀNG</button>
      </div>
     </form>
    </div>
    <!-- Right Column -->
    <div class="right-column">
     <h2>Thông tin đơn hàng</h2>
     @foreach ($carts as $index => $cart)
     <div class="cart-item">
      <img alt="{{ $cart['name'] }}" src="{{ $cart['image'] }}"/>
      <div>
       <p>{{ $cart['name'] }}</p>
       <p>Màu sắc: {{ $cart['color'] }}</p>
       <p>Kích cỡ: {{ $cart['size'] }}</p>
      </div>
      <div>
       <p>{{ $cart['quantity'] }}</p>
       <p>{{ number_format($cart['price']) }} VND</p>
       <p>{{ number_format($cart['price'] * $cart['quantity']) }} VND</p>
      </div>
     </div>
     @endforeach
     <div class="text-right" style="margin-top: 20px;">
     <p>Tổng sản phẩm: {{ $carts->sum('quantity') }}</p>
      <p>Tổng tiền: {{ number_format($total) }} VND</p>
      <p>Vận chuyển: 30,000 VND</p>
      <div id="coupon_message"></div>
      <p class="total">Tổng thanh toán: {{ number_format($total + 30000) }} VND</p>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$('#apply_coupon').click(function (e) {
    e.preventDefault();
    let couponCode = $('#coupon_code').val();
    let total = {{ $total }}; 
    let shippingFee = 30000; // Phí vận chuyển cố định

    if (couponCode === '') {
        alert('Vui lòng nhập mã giảm giá!');
        return;
    }

    $.ajax({
        url: '/apply-coupon',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            code: couponCode,
            total: total
        },
        success: function (response) {
            console.log('Discount Applied:', response.discount_applied);
            console.log('New Total:', response.new_total);

            let discountFormatted = parseFloat(response.discount_applied).toLocaleString('vi-VN'); 
            let newTotalWithShipping = (parseFloat(response.new_total) + shippingFee).toLocaleString('vi-VN');

            $('#coupon_message').html(`<p style="color: green;">Giảm giá: ${discountFormatted} VND</p>`);
            $('.total').text(`Tổng thanh toán: ${newTotalWithShipping} VND`);
            
            $('#discount_amount').val(response.discount_applied);
        },
        error: function (xhr) {
            let errorMessage = xhr.responseJSON.error;
            $('#coupon_message').html(`<p style="color: red;">${errorMessage}</p>`);
        }
    });
});

</script>

 </body>
</html>

@include('layout.footer')

<!-- AJAX Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
