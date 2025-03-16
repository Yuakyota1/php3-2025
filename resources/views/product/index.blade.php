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
                <ul class="la-nav-list-items">
                    <li class="ng-scope">
                        <a href="./index.html">Trang chủ</a>
                    </li>
                    <li class="ng-scope">
                        <a href="./intro.html">Giới thiệu</a>
                    </li>
                    <li class="ng-scope ng-has-child1">
                        <a href="./Product.html">Sản phẩm <i class="fas fa-plus cong"></i> <i class="fas fa-minus tru hidden"></i></a>
                        <ul class="ul-has-child1">
                            <li class="ng-scope ng-has-child2">
                                <a href="./Product.html">Tất cả sản phẩm <i class="fas fa-plus cong1" onclick="hienthi(1,`abc`)"></i> <i
                                        class="fas fa-minus tru1 hidden" onclick="hienthi(1,`abc`)"></i></a>
                                <ul class="ul-has-child2 hidden" id="abc">
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng đá</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Chạy</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Cầu lông</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng rổ</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Quần vợt</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bơi lội</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">GOLF</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="ng-scope ng-has-child2">
                                <a href="./Product.html">Quần áo <i class="fas fa-plus cong2" onclick="hienthi(2,`abc2`)"></i> <i
                                        class="fas fa-minus tru2 hidden" onclick="hienthi(2,`abc2`)"></i></a>
                                <ul class="ul-has-child2 hidden" id="abc2">
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng đá</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Chạy</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Cầu lông</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng rổ</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Quần vợt</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bơi lội</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">GOLF</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="ng-scope ng-has-child2">
                                <a href="./Product.html">Già dép<i class="fas fa-plus cong3" onclick="hienthi(3,`abc3`)"></i> <i
                                        class="fas fa-minus tru3 hidden" onclick="hienthi(3,`abc3`)"></i></a>
                                <ul class="ul-has-child2 hidden" id="abc3">
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng đá</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Chạy</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Cầu lông</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng rổ</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Quần vợt</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bơi lội</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">GOLF</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="ng-scope ng-has-child2">
                                <a href="./Product.html">Phụ kiện <i class="fas fa-plus cong4" onclick="hienthi(4,`abc4`)"></i> <i
                                        class="fas fa-minus tru4 hidden " onclick="hienthi(4,`abc4`)"></i></a>
                                <ul class="ul-has-child2 hidden" id="abc4">
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng đá</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Chạy</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Cầu lông</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bóng rổ</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Quần vợt</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">Bơi lội</a>
                                    </li>
                                    <li class="ng-scope">
                                        <a href="./Product.html">GOLF</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="ng-scope">
                        <a href="./news.html">Tin tức</a>
                    </li>
                    <li class="ng-scope">
                        <a href="./contact.html">Liên hệ</a>
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
    <div class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 hidden-xs hidden-sm">
                    <div class="product__filter">
                        <div class="product__filter-price">
                            <h4 class="product__filter-heading">Khoảng giá <i class="fi-rs-minus"
                                    onclick="khonghienthidanhsach(1,`khoanggia`)" id="minus-1"></i> <i class="fi-rs-plus hidden"
                                    id="plus-1" onclick="khonghienthidanhsach(1,`khoanggia`)"></i></h4>
                            <ul id="khoanggia" class="product__filter-ckeckbox">
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="kg1">
                                        <input type="radio" class="form-check-input checkGia" id="kg1" name="optradio" value="0-1000000" onclick="checkgia(1)"><span>Dưới 1,000,000đ</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="kg2">
                                        <input type="radio" class="form-check-input checkGia" id="kg2" name="optradio" value="1000000-2000000" onclick="checkgia(2)"><span>1,000,000đ->2,000,000đ</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="kg3">
                                        <input type="radio" class="form-check-input checkGia" id="kg3" name="optradio" value="2000000-3000000" onclick="checkgia(3)"><span>2,000,000đ->3,000,000đ</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="kg4">
                                        <input type="radio" class="form-check-input checkGia" id="kg4" name="optradio" value="3000000-4000000" onclick="checkgia(4)"><span>3,000,000đ->4,000,000đ</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="kg5">
                                        <input type="radio" class="form-check-input checkGia" id="kg5" name="optradio" value="4000000-100000000" onclick="checkgia(5)"><span>Trên 4,000,000đ</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="product__filter-trademark">
                            <h4 class="product__filter-heading">Thương hiệu <i class="fi-rs-minus"
                                    onclick="khonghienthidanhsach(2,`thuonghieu`)" id="minus-2"></i> <i class="fi-rs-plus hidden"
                                    onclick="khonghienthidanhsach(2,`thuonghieu`)" id="plus-2"></i></h4>
                            <ul id="thuonghieu" class="product__filter-ckeckbox">
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="th1">
                                        <input type="checkbox" class="form-check-input checkthuonghieu checkthuonghieu" id="th1" name="option2"
                                            value="something"><span>Adidas</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="th2">
                                        <input type="checkbox" class="form-check-input checkthuonghieu" id="th2" name="option2"
                                            value="something"><span>Nike</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="th3">
                                        <input type="checkbox" class="form-check-input checkthuonghieu" id="th3" name="option2"
                                            value="something"><span>Puma</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="th4">
                                        <input type="checkbox" class="form-check-input checkthuonghieu" id="th4" name="option2"
                                            value="something"><span>DESPORTE</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="th5">
                                        <input type="checkbox" class="form-check-input checkthuonghieu" id="th5" name="option2"
                                            value="something"><span>X-MUNICH</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="th6">
                                        <input type="checkbox" class="form-check-input checkthuonghieu" id="th6" name="option2"
                                            value="something"><span>GRAND SPORT</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="product__filter-size">
                            <h4 class="product__filter-heading">Size <i class="fi-rs-minus" onclick="khonghienthidanhsach(3,`size`)"
                                    id="minus-3"></i> <i class="fi-rs-plus hidden" onclick="khonghienthidanhsach(3,`size`)"
                                    id="plus-3"></i></h4>
                            <ul id="size" class="product__filter-ckeckbox">
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="size1">
                                        <input type="checkbox" class="form-check-input checksize" id="size1" name="option2"
                                            value="something"><span>37.5</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="size2">
                                        <input type="checkbox" class="form-check-input checksize" id="size2" name="option2"
                                            value="something"><span>38</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="size3">
                                        <input type="checkbox" class="form-check-input checksize" id="size3" name="option2"
                                            value="something"><span>38.5</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="size4">
                                        <input type="checkbox" class="form-check-input checksize" id="size4" name="option2"
                                            value="something"><span>x</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="size5">
                                        <input type="checkbox" class="form-check-input checksize" id="size5" name="option2"
                                            value="something"><span>xl</span>
                                    </label>
                                </li>
                                <li class="product__filter-item">
                                    <label class="form-check-label" for="size6">
                                        <input type="checkbox" class="form-check-input checksize" id="size6" name="option2"
                                            value="something"><span>l</span>
                                    </label>
                                </li>
                            </ul>
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
                                        <a class="dropdown-item" id="sort1">Giá: Tăng dần</a>
                                        <a class="dropdown-item" id="sort2">Giá: giảm dần</a>
                                        <a class="dropdown-item" id="sort3">Tên A->Z</a>
                                        <a class="dropdown-item" id="sort4">Tên Z->A</a>
                                        <a class="dropdown-item" id="sort5">Cũ nhất</a>
                                        <a class="dropdown-item" id="sort6">Mới nhất</a>
                                        <a class="dropdown-item" id="sort7">Bán chạy nhất</a>
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
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                        @php
                        $images = json_decode($product->images, true);
                        $firstImage = !empty($images) && is_array($images) ? $images[0] : 'default.jpg';
                        @endphp

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top" alt="{{ $product->product_name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->product_name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <a href="{{ url('product/detail/' . $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="loadmore">
                        <a style="cursor: pointer;" class="loadmore-btn">Tải thêm</a>
                    </div>


                </div>


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
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">

                <!-- Modal Header -->
                <!-- <div class="modal-header">
          <h4 class="modal-title">Giày ADIDAS</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2 main-img-2">
                                <img src="./assets/img/product/ars1.jpg" alt="" id="img-main" xoriginal="./assets/img/product/ars1.jpg">
                            </div>
                            <ul class="all-img-2">
                                <li class="img-item-2">
                                    <img src="./assets/img/product/ars1.jpg" alt="" onclick="changeImg('one')" id="one">
                                </li>
                                <li class="img-item-2">
                                    <img src="./assets/img/product/ars2.jpg" alt="" onclick="changeImg('two')" id="two">
                                </li>
                                <li class="img-item-2">
                                    <img src="./assets/img/product/ars3.jpg" alt="" onclick="changeImg('three')" id="three">
                                </li>
                                <li class="img-item-2">
                                    <img src="./assets/img/product/ars4.jpg" alt="" onclick="changeImg('four')" id="four">
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <div class="info-product">
                                <h3 class="product-name">
                                    <a href="" title="">Giày ADIDAS</a>
                                </h3>
                                <div class="status-product">
                                    Trạng thái: <b>Còn hàng</b>
                                </div>
                                <div class="infor-oder">
                                    Loại sản phẩm: <b>Giày dép</b>
                                </div>
                                <div class="price-product">
                                    <div class="special-price">
                                        <span>540.000đ</span>
                                    </div>
                                    <div class="price-old">
                                        Giá gốc:
                                        <del>650.000đ</del>
                                        <span class="discount">(-20%)</span>
                                    </div>
                                </div>
                                <div class="product-description">
                                    Đầu tháng /2021, Nike chính thức trình
                                    làng thế hệ tiếp theo của dòng giày đá bóng huyền thoại
                                    thuộc nhà Swoosh là Tiempo Legend 9. Được mệnh danh là
                                    thế hệ nhẹ nhất từ trước đến nay của dòng giày đá bóng Tiempo,
                                    Legend 9 đã có những thay đổi đáng kể
                                    về mặt thiết kế lẫn công nghệ nhằm giúp người chơi có thể tự
                                    tin và phát huy tối đa khả năng khi chơi bóng.
                                </div>

                                <div class="product__color d-flex" style="align-items: center;">
                                    <div class="title" style="font-size: 16px; margin-right: 10px;">
                                        Màu:
                                    </div>
                                    <div class="select-swap d-flex">

                                        <div class="circlecheck">
                                            <input type="radio" id="f-option" class="circle-1" name="selector" checked>
                                            <label for="f-option"></label>
                                            <div class="outer-circle"></div>
                                        </div>
                                        <div class="circlecheck">
                                            <input type="radio" id="g-option" class="circle-2" name="selector">
                                            <label for="g-option"></label>
                                            <div class="outer-circle"></div>
                                        </div>
                                        <div class="circlecheck">
                                            <input type="radio" id="h-option" class="circle-3" name="selector">
                                            <label for="h-option"></label>
                                            <div class="outer-circle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product__size d-flex" style="align-items: center;">
                                    <div class="title" style="font-size: 16px; margin-right: 10px;">
                                        Kích thước:
                                    </div>
                                    <div class="select-swap">
                                        <div class="swatch-element" data-value="38">
                                            <input type="radio" class="variant-1" id="swatch-1-38" name="mau" value="trung" onclick="check()">
                                            <label for="swatch-1-38" class="sd"><span>38</span></label>
                                        </div>
                                        <div class="swatch-element" data-value="39">
                                            <input type="radio" class="variant-1" id="swatch-1-39" name="mau" value="thanh" onclick="check()">
                                            <label for="swatch-1-39" class="sd"><span>39</span></label>
                                        </div>
                                        <div class="swatch-element" data-value="40">
                                            <input type="radio" class="variant-1" id="swatch-1-40" name="mau" value="hieu" onclick="check()">
                                            <label for="swatch-1-40" class="sd"><span>40</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="product__wrap">
                                    <div class="product__amount">
                                        <label for="">Số lượng: </label>
                                        <input type="button" value="-" class="control" onclick="tru()" id="cong">
                                        <input type="text" value="1" class="text-input" id="text_so_luong" onkeypress='validate(event)'>
                                        <input type="button" value="+" class="control" onclick="cong()">
                                    </div>
                                </div>
                                <div class="product__shopnow">
                                    <button class="shopnow2">Mua ngay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn-default btn-close" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i>
                </button>
                <!-- Modal footer -->
                <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->

            </div>
        </div>
    </div>
    <!-- end modal -->
</body>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/product.js"></script>


</html>