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
        .carousel-item img {
            max-height: 400px;
            object-fit: contain;
        }
        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        h2, h4, h5 {
    font-size: 1.8rem;
}

p, label, select, input {
    font-size: 1.2rem;
}

#productPrice {
    font-size: 1.5rem;
}

    </style>
</head>
<body>
    @include('layout.header')

    <div class="container py-4">
        <h2>Chi tiết sản phẩm</h2>
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php $images = json_decode($product->images, true); @endphp
                        @if (!empty($images) && is_array($images))
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
                        @foreach ($product->sizeColors->unique('idSize') as $sizeColor)
                            <option value="{{ $sizeColor->idSize }}">{{ $sizeColor->size->size_name ?? 'Không xác định' }}</option>
                        @endforeach
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
                <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>
    </div>

    @include('layout.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
        });
    </script>
</body>
</html>
