<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layout.head')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .carousel-item img { max-height: 400px; object-fit: contain; }
        .product-info { display: flex; flex-direction: column; justify-content: center; }
        h2, h4, h5 { font-size: 1.8rem; }
        p, label, select, input { font-size: 1.2rem; }
        #productPrice { font-size: 1.5rem; }
        
        /* Styling for comment form */
        .comment-box {
            border-radius: 10px;
            background: #f8f9fa;
            padding: 15px;
            margin-left: 280px;
            margin-right: 100px;
        }
        .comment-box strong {
            color: #007bff;
        }
        .comment-box img {
            border-radius: 5px;
            margin-top: 10px;
        }
        .comment-form {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 280px;
            margin-right: 100px;
        }
        .comment-form textarea {
            resize: none;
            border-radius: 5px;
        }
        .rating input { display: none; }
        .rating label {
            font-size: 1.5rem;
            cursor: pointer;
            color: gray;
        }
        .rating input:checked ~ label {
            color: gold;
        }
    </style>
</head>
<body>
<!-- Modal thông báo -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="notificationMessage">Nội dung thông báo.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

    @include('layout.header')

    <div class="container py-4">
        <h2>Chi tiết sản phẩm</h2>
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php $images = json_decode($product->images, true) ?? []; @endphp
                        @if (!empty($images))
                            @foreach ($images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 img-fluid rounded" alt="{{ $product->product_name }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

            <div class="col-md-6 product-info">
                <h4>{{ $product->product_name }}</h4>
                <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                <p><strong>ID sản phẩm:</strong> {{ $product->id }}</p>
                <p><strong>Danh mục con:</strong> {{ $product->subCategory->subcategory_name ?? 'Không xác định' }}</p>

                <h5 class="mt-4">Chọn kích thước & màu sắc</h5>
                <div class="mb-3">
                    <label for="sizeSelect" class="form-label">Chọn kích thước:</label>
                    <select id="sizeSelect" class="form-control">
                        <option value="">-- Chọn kích thước --</option>
                        @if (!empty($product->sizeColors) && is_iterable($product->sizeColors))
                            @foreach ($product->sizeColors->unique('idSize') as $sizeColor)
                                <option value="{{ $sizeColor->idSize }}">{{ $sizeColor->size->size_name ?? 'Không xác định' }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label for="colorSelect" class="form-label">Chọn màu sắc:</label>
                    <select id="colorSelect" class="form-control" disabled>
                        <option value="">-- Chọn màu --</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantityInput" class="form-label">Số lượng:</label>
                    <input type="number" id="quantityInput" class="form-control" value="1" min="1">
                </div>

                <p class="mt-2"><strong>Giá:</strong> <span id="productPrice" class="text-danger fs-5">0 VND</span></p>
                <button id="addToCartBtn" class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
                <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>
    </div>

    @if (!empty($product->comments) && is_iterable($product->comments))
        @foreach($product->comments as $comment)
            <div class="comment-box border p-3 my-2">
                <strong>{{ $comment->user->name ?? 'Khách' }} 
                @if(isset($comment->rating))
    <div class="rating-display">
        @for ($i = 1; $i <= 5; $i++)
            <span class="{{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}">★</span>
        @endfor
    </div>
@endif

                </strong> thời gian
                <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                <p>{{ $comment->content }}</p>
                
                @if ($comment->image)
                    <img src="{{ asset('storage/' . $comment->image) }}" width="100">
                @endif
                
                @if (Auth::id() === $comment->user_id)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                @endif
            </div>
        @endforeach
    @endif

    @if (Auth::check() && !$product->comments->contains('user_id', Auth::id()))
    <div class="comment-form mt-4">
        <h4>Viết bình luận</h4>
        <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="mb-3">
                <label class="form-label">Đánh giá sản phẩm:</label>
                <div class="rating d-flex">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1" checked><label for="star1">★</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Bình luận:</label>
                <textarea name="content" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tải ảnh lên (tùy chọn):</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>
    </div>
    @endif

    @include('layout.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

   
<script>
$(document).ready(function() {
    let allData = @json($product->sizeColors->toArray());
    let basePrice = 0;

    $('#sizeSelect').change(function() {
        let selectedSize = $(this).val();
        let colors = allData.filter(item => item.idSize == selectedSize);
        
        $('#colorSelect').html('<option value="">-- Chọn màu --</option>');
        colors.forEach(item => {
            $('#colorSelect').append(`<option value="${item.color}" data-price="${item.price}">${item.color}</option>`);
        });

        $('#colorSelect').prop('disabled', colors.length === 0);
        $('#productPrice').text('0 VND');
        basePrice = 0;
    });

    $('#colorSelect').change(function() {
        basePrice = $(this).find(':selected').data('price') || 0;
        updateTotalPrice();
    });

    $('#quantityInput').on('input', function() {
        updateTotalPrice();
    });

    function updateTotalPrice() {
        let quantity = parseInt($('#quantityInput').val()) || 1;
        let totalPrice = basePrice * quantity;
        $('#productPrice').text(new Intl.NumberFormat('vi-VN').format(totalPrice) + ' VND');
    }

    function showPopup(message) {
        $('#notificationMessage').text(message);
        $('#notificationModal').modal('show');
    }

    $('#addToCartBtn').click(function() {
    let size = $('#sizeSelect').val();
    let color = $('#colorSelect').val();
    let quantity = $('#quantityInput').val();
    let productId = "{{ $product->id }}";
    let name = "{{ $product->product_name }}";
    let image = "{{ asset('storage/' . (isset($images[0]) ? $images[0] : 'default.jpg')) }}";

    if (!size || !color) {
        showPopup('Vui lòng chọn kích thước và màu sắc!');
        return;
    }

    $.ajax({
        url: "{{ route('cart.store') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            product_id: productId,
            size: size,
            color: color,
            name: name,
            quantity: quantity,
            price: basePrice,
            total_price: basePrice * quantity,
            image: image
        },
        success: function(response) {
    showPopup(response.message); // Hiển thị popup
    setTimeout(function() {
        window.location.href = "{{ route('cart.index') }}"; // Chuyển trang sau 2 giây
    }, 2000);

        },
        error: function() {
            showPopup('Có lỗi xảy ra!');
        }
    });
});


    @if(session('success'))
        showPopup("{{ session('success') }}");
    @endif

    @if(session('error'))
        showPopup("{{ session('error') }}");
    @endif
});
</script>

</body>
</html>
