<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head') {{-- Gọi file head.blade.php trong thư mục layout --}}
</head>
<style>
    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #2196F3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        border-left: none;
        cursor: pointer;
    }

    form.example button:hover {
        background: #0b7dda;
    }

    form.example::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Mobile & tablet  */
    @media (max-width: 1023px) {
        .sortby {
            float: left;
        }

        .sortby label {
            display: none;
        }

        .sort-left {
            margin-bottom: 20px;
        }

        .sortby2 {
            display: block;
        }

        .sortby {
            float: left;
        }
    }

    /* tablet */
    @media (min-width: 740px) and (max-width: 1023px) {}

    /* mobile */
    @media (max-width: 739px) {}
</style>

<body>
    <div class="overlay hidden"></div>
    <!-- mobile menu -->
    <div class="mobile-main-menu">
        <div class="drawer-header">
            <a href="">
                <div class="drawer-header--auth">
                    <div class="_object">
                        <img src="./assets/img/product/giayxah2.jpg" alt="">
                    </div>
                    <div class="_body">Đăng nhập
                        <br>Nhận nhiều ưu đãi hơn
                    </div>
                </div>
            </a>
        </div>
        <ul class="ul-first-menu">
            <li>
                <a href="">Đăng nhập</a>
            </li>
            <li>
                <a href="" class="abc">Đăng kí</a>
            </li>
        </ul>
        <!-- <ul class="ul-first-menu">
      <li>
        <a href="">Tài khoản của tôi</a>
      </li>
      <li>
        <a href="">Địạ chỉ của tôi</a>
      </li>
      <li>
        <a href="">Đơn mua</a>
      </li>
      <li>
        <a href="" class="list-like-noicte">Danh sách yêu thích</a>
        <span id="header__second__like--notice" class="header__second__like--notice">3</span>
      </li>
      <li>
        <a href="">Đăng xuất</a>
      </li> -->
        </ul>
        <div class="la-scroll-fix-infor-user">
            <div class="la-nav-menu-items">
                <div class="la-title-nav-items">
                    <strong>Danh mục</strong>
                </div>

                <li class="ng-scope ng-has-child1">
                    <a href="./Product.html">Sản phẩm <i class="fas fa-plus cong"></i> <i class="fas fa-minus tru hidden"></i></a>
                    <ul class="ul-has-child1">
                        <li class="ng-scope ng-has-child2">
                            <a href="./Product.html">Tất cả sản phẩm <i class="fas fa-plus cong1" onclick="hienthi(1,`abc`)"></i> <i
                                    class="fas fa-minus tru1 hidden" onclick="hienthi(1,`abc`)"></i></a>


                        </li>
                    </ul>
            </div>
        </div>
        <ul class="mobile-support">
            <li>
                <div class="drawer-text-support">Hỗ trợ</div>
            </li>
            <li>
                <i class="fas fa-phone-square-alt footer__item-icon">HOTLINE: </i>
                <a href="tel:19006750">19006750</a>
            </li>
            <li>
                <i class="fas fa-envelope-square footer__item-icon">Email: </i>
                <a href="mailto:support@sapo.vn">support@gmail.vn</a>
            </li>
        </ul>
    </div>
    <!-- end mobile menu -->
    <!-- header -->
    @include('layout.header')
    <!-- end header -->
    <!-- product -->
    <br>
    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 hidden-xs hidden-sm">
                    <div class="product__filter">
                        <div class="product__filter-size">

                            <form id="filter-form" action="{{ route('shop') }}" method="GET">
                                <div class="accordion" id="categoryAccordion">
                                    @foreach ($categories as $category)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $category->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $category->id }}" aria-expanded="false"
                                                aria-controls="collapse{{ $category->id }}">
                                                <input type="checkbox" class="form-check-input check-category" name="category[]"
                                                    value="{{ $category->id }}" onchange="this.form.submit()"
                                                    {{ in_array($category->id, (array) request()->input('category', [])) ? 'checked' : '' }}>

                                                <span>{{ $category->category_name }}</span>
                                            </button>
                                        </h2>

                                        @if ($category->subcategories->count() > 0)
                                        <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $category->id }}" data-bs-parent="#categoryAccordion">
                                            <div class="accordion-body">
                                                @foreach ($category->subcategories as $subcategory)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input check-subcategory" name="subcategory[]"
                                                        value="{{ $subcategory->id }}" onchange="this.form.submit()"
                                                        {{ in_array($subcategory->id, (array) request()->input('subcategory', [])) ? 'checked' : '' }}>

                                                    <label class="form-check-label">
                                                        {{ $subcategory->subcategory_name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </form>




                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="sort-wrap row">
                        <div class="sort-left col-12 col-lg-6">
                            <h1 class="coll-name">Tất cả sản phẩm</h1>
                        </div>
                        <div class="sort-right col-12 col-lg-6">
                            <div class="sortby">
                                <label for="">Sắp xếp theo:</label>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                        Sản phẩm nổi bật
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" id="sort3" onclick="sortProducts('asc')">Tên A->Z</a>
                                        <a class="dropdown-item" id="sort4" onclick="sortProducts('desc')">Tên Z->A</a>
                                    </div>
                                </div>
                            </div>
                            <div class="sortby2 hidden" style="float: right;">
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" id="filter">
                                        Lọc sản phẩm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-product" id="products">
                        @foreach ($products as $product)
                        @php
                        $images = json_decode($product->images, true);
                        $firstImage = !empty($images) && is_array($images) ? asset('storage/' . $images[0]) : asset('storage/default.jpg');
                        $isFavorite = auth()->check() && auth()->user()->favorites->contains('product_id', $product->id);
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ $firstImage }}" alt="{{ $product->product_name }}" style="width:100%">
                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title">{{ $product->product_name }}</h4>
                                    <p class="card-text description" style="font-weight: 400;">{{ $product->description }}</p>

                                    <!-- Căn chỉnh hàng chứa 2 nút -->
                                    <div class="mt-auto d-flex align-items-center">
                                        <!-- Nút Xem Ngay (sát trái) -->
                                        <a href="{{ url('product/detail/' . $product->id) }}"
                                            class="btn btn-buynow d-flex align-items-center justify-content-start"
                                            style="height: 45px; padding: 0 20px; flex-grow: 1;">
                                            <span>Xem ngay</span>
                                            <i class="fas fa-arrow-right" style="font-size: 16px; margin-left: 5px;"></i>
                                        </a>


                                        <!-- Nút Yêu Thích -->
                                        @auth
                                        <form action="{{ route('favorites.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-outline-danger d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <i class="{{ $isFavorite ? 'fas fa-heart' : 'far fa-heart' }}" style="font-size: 20px;"></i>
                                            </button>
                                        </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <script>
                        function sortProducts(order) {
                            const productContainer = document.getElementById('products');
                            const products = Array.from(productContainer.getElementsByClassName('col-lg-4'));

                            products.sort((a, b) => {
                                const nameA = a.querySelector('.card-title').textContent.trim().toLowerCase();
                                const nameB = b.querySelector('.card-title').textContent.trim().toLowerCase();

                                if (order === 'asc') {
                                    return nameA.localeCompare(nameB); // A-Z
                                } else {
                                    return nameB.localeCompare(nameA); // Z-A
                                }
                            });

                            // Xóa nội dung hiện tại và thêm lại các sản phẩm đã sắp xếp
                            productContainer.innerHTML = '';
                            products.forEach(product => productContainer.appendChild(product));
                        }

                        document.addEventListener("DOMContentLoaded", function() {
                            document.querySelectorAll('.favorite-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    let productId = this.getAttribute('data-product-id');
                                    let isFavorite = this.getAttribute('data-favorite') === 'true';
                                    let url = isFavorite ? `/favorites/remove/${productId}` : `/favorites/add/${productId}`;

                                    fetch(url, {
                                            method: isFavorite ? 'DELETE' : 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                            }
                                        }).then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                this.setAttribute('data-favorite', !isFavorite);
                                                this.innerHTML = `<i class="fa ${!isFavorite ? 'fa-heart' : 'fa-heart-o'}"></i> Yêu thích`;
                                            }
                                        });
                                });
                            });
                        });
                    </script>


                </div>
            </div>
        </div>
        <!-- end product -->
    </div>
    </div>
    </div>
    <!-- end bộ lộc mobile -->
    <!-- end product -->
    <!-- footer -->
    @include('layout.footer')
    <!-- end footer -->
    <!-- modal -->
    <!-- The Modal -->

    <!-- end modal -->
</body>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/product.js"></script>


</html>