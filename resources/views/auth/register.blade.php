<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>P&T Shop</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- link font chữ -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
  <!-- link icon -->
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- link css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
  <link href="{{ asset('css/responsive1.css') }}" rel="stylesheet">
  <link href="{{ asset('css/productdetail.css') }}" rel="stylesheet">
  <link rel="icon" href="./assets/img/logo/main.png" type="image/x-icon" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"></script>
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
    .custom-btn {
      margin: unset;
    }
  }

  /* tablet */
  @media (min-width: 740px) and (max-width: 1023px) {
    .btn-blocker {
      display: block;
      width: 100%;
    }

    .show-hide {
      top: 56px;
    }

    .show-hide-two {
      top: 56px;
    }
  }

  /* mobile */
  @media (max-width: 739px) {
    .btn-blocker {
      display: block;
      width: 100%;
    }

    .show-hide {
      top: 56px;
    }

    .show-hide-two {
      top: 56px;
    }
  }
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
  <header class="header">
    <div class="container">
      <div class="top-link clearfix hidden-sm hidden-xs">
        <div class="row">
          <div class="col-6 social_link">
            <div class="social-title">Theo dõi: </div>
            <a href=""><i class="fab fa-facebook" style="font-size: 24px; margin-right: 10px"></i></a>
            <a href=""><i class="fab fa-instagram" style="font-size: 24px; margin-right: 10px;color: pink;"></i></a>
            <a href=""><i class="fab fa-youtube" style="font-size: 24px; margin-right: 10px;color: red;"></i></a>
            <a href=""><i class="fab fa-twitter" style="font-size: 24px; margin-right: 10px"></i></a>
          </div>
          <div class="col-6 login_link">
            <ul class="header_link right m-auto">
              <li>
                <a href="./Login.html"><i class="fas fa-sign-in-alt mr-3"></i>Đăng nhập</a>
              </li>
              <li>
                <a href="./registration.html"><i class="fas fa-user-plus mr-3" style="margin-left: 10px;"></i>Đăng kí</a>
              </li>
            </ul>
            <!-- <ul class="nav nav__first right">
                <li class="nav-item nav-item__first nav-item__first-user">
                  <img src="./assets/img/product/noavatar.png" alt="" class="nav-item__first-img">
                  <span class="nav-item__first-name">Quốc Trung</span>
                  <ul class="nav-item__first-menu">
                    <li class="nav-item__first-item">
                      <a href="">Tài khoản của tôi</a>
                    </li>
                    <li class="nav-item__first-item">
                      <a href="">Địa chỉ của tôi</a>
                    </li>
                    <li class="nav-item__first-item">
                      <a href="">Đơn mua</a>
                    </li>
                    <li class="nav-item__first-item">
                      <a href="">Đăng xuất</a>
                    </li>
                  </ul>
                </li>
              </ul> -->
          </div>
        </div>
      </div>
      <div class="header-main clearfix">
        <div class="row">
          <div class="col-lg-3 col-100-h">
            <div id="trigger-mobile" class="visible-sm visible-xs"><i class="fas fa-bars"></i></div>
            <div class="logo">
              <a href="">
                <img src="./assets/img/logo/logomain.png" alt="">
              </a>
            </div>
            <div class="mobile_cart visible-sm visible-xs">
              <a href="./cart.html" class="header__second__cart--icon">
                <i class="fas fa-shopping-cart"></i>
                <span id="header__second__cart--notice" class="header__second__cart--notice">3</span>
              </a>
              <a href="./listlike.html" class="header__second__like--icon">
                <i class="far fa-heart"></i>
                <span id="header__second__like--notice" class="header__second__like--notice">3</span>
              </a>
            </div>
          </div>
          <div class="col-lg-6 m-auto pdt15">
            <form class="example" action="./Product.html">
              <input type="text" class="input-search" placeholder="Tìm kiếm.." name="search">
              <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div class="col-3 m-auto hidden-sm hidden-xs">
            <div class="item-car clearfix">
              <a href="./cart.html" class="header__second__cart--icon">
                <i class="fas fa-shopping-cart"></i>
                <span id="header__second__cart--notice" class="header__second__cart--notice">3</span>
              </a>
            </div>
            <div class="item-like clearfix">
              <a href="./listlike.html" class="header__second__like--icon">
                <i class="far fa-heart"></i>
                <span id="header__second__like--notice" class="header__second__like--notice">3</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="header_nav hidden-sm hidden-xs">
      <div class="container">
        <ul class="header_nav-list nav">
          <li class="header_nav-list-item "><a href="./index.html" class="active">Trang chủ</a></li>
          <li class="header_nav-list-item"><a href="./intro.html">Giới thiệu</a></li>
          <li class="header_nav-list-item has-mega">
            <a href="./Product.html">Sản phẩm<i class="fas fa-angle-right" style="margin-left: 5px;"></i></a>
            <div class="mega-content" style="overflow-x: hidden;">
              <div class="row">
                <ul class="col-8 no-padding level0">
                  <li class="level1">
                    <a class="hmega" href="./Product.html">Tất cả sản phẩm</a>
                    <!-- <ul class="level1">
                        <li class="level2"><a href="">Bóng đá</a></li>
                        <li class="level2"><a href="">Bóng đá</a></li>
                        <li class="level2"><a href="">Bóng đá</a></li>
                        <li class="level2"><a href="">Bóng đá</a></li>
                      </ul> -->
                  </li>
                  <li class="level1">
                    <a class="hmega">Giày, dép</a>
                    <ul class="level1">
                      <li class="level2"><a href="./Product.html">Bóng đá</a></li>
                      <li class="level2"><a href="./Product.html">Chạy</a></li>
                      <li class="level2"><a href="./Product.html">Cầu lông</a></li>
                      <li class="level2"><a href="./Product.html">Bóng rổ</a></li>
                      <li class="level2"><a href="./Product.html">Quần vợt</a></li>
                    </ul>
                  </li>
                  <li class="level1">
                    <a class="hmega">Quần, áo</a>
                    <ul class="level1">
                      <li class="level2"><a href="./Product.html">Bóng đá</a></li>
                      <li class="level2"><a href="./Product.html">Chạy</a></li>
                      <li class="level2"><a href="./Product.html">Cầu lông</a></li>
                      <li class="level2"><a href="./Product.html">Bóng rổ</a></li>
                      <li class="level2"><a href="./Product.html">Quần vợt</a></li>
                    </ul>
                  </li>
                  <li class="level1">
                    <a class="hmega">Phụ kiện</a>
                    <ul class="level1">
                      <li class="level2"><a href="./Product.html">Bóng đá</a></li>
                      <li class="level2"><a href="./Product.html">Chạy</a></li>
                      <li class="level2"><a href="./Product.html">Cầu lông</a></li>
                      <li class="level2"><a href="./Product.html">Bóng rổ</a></li>
                      <li class="level2"><a href="./Product.html">Quần vợt</a></li>
                      <li class="level2"><a href="./Product.html">Bơi lội</a></li>
                      <li class="level2"><a href="./Product.html">Golf</a></li>
                    </ul>
                  </li>
                </ul>
                <div class="col-4">
                  <a href="">
                    <picture>
                      <img src="https://media.giphy.com/media/mj7HcKFq23oobJMcOG/giphy.gif" alt="" width="80%">
                    </picture>
                  </a>
                </div>
              </div>
            </div>
          </li>
          <li class="header_nav-list-item"><a href="./news.html">Tin tức</a></li>
          <li class="header_nav-list-item"><a href="./contact.html">Liên hệ</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- end header -->
  <!-- registration form -->
  <div class="container">
    <div class="registration__form">
        <div class="row">
            <!-- Cột 1: Form đăng ký -->
            <div class="col-sm-12 col-lg-6">
                <form action="{{ route('register') }}" method="POST" class="form" id="form-1">
                    @csrf
                    <h3 class="heading">ĐĂNG KÍ</h3>

                    <div class="form-group">
                        <label for="name" class="form-label">Tên đầy đủ</label>
                        <input id="name" name="name" type="text" placeholder="VD: Quốc Trung" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <span class="form-message text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" placeholder="VD: email@domain.com" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                        <span class="form-message text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group matkhau">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control @error('password') is-invalid @enderror">
                        <span class="show-hide"><i class="fas fa-eye"></i></span>
                        @error('password')
                        <span class="form-message text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group matkhau">
                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                        <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                        <span class="show-hide-two"><i class="fas fa-eye fa-eye-2"></i></span>
                    </div>

                    <button class="form-submit btn-blocker" style="border-radius: unset;">Đăng ký <i class="fas fa-arrow-right" style="font-size: 16px;margin-left: 10px;"></i></button>

                    <p style="font-size: 16px;margin: 10px 0;">Bạn đã có tài khoản? 
                        <a href="{{ route('login') }}" style="color: black; font-weight: bold">Đăng nhập</a>
                    </p>
                </form>
            </div>

            <!-- Cột 2: Thông tin lợi ích -->
            <div class="col-sm-12 col-lg-6">
                <h3 class="heading">TẠO MỘT TÀI KHOẢN</h3>
                <p class="text-login">Đăng nhập bằng tài khoản sẽ giúp bạn truy cập:</p>
                <ul>
                    <li class="text-login-item"><i class="fas fa-check"></i>
                        <p class="text-login">Một lần đăng nhập chung duy nhất để tương tác với các sản phẩm và dịch vụ của P&T shop</p>
                    </li>
                    <li class="text-login-item"><i class="fas fa-check"></i>
                        <p class="text-login">Thanh toán nhanh hơn</p>
                    </li>
                    <li class="text-login-item"><i class="fas fa-check"></i>
                        <p class="text-login">Xem lịch sử đặt hàng riêng của bạn</p>
                    </li>
                    <li class="text-login-item"><i class="fas fa-check"></i>
                        <p class="text-login">Thêm hoặc thay đổi tùy chọn email</p>
                    </li>
                </ul>
            </div>
        </div> <!-- Kết thúc .row -->
    </div>
</div>

  <!-- end registration form -->
  <!-- footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3">
          <img src="./assets/img/logo/logomain.png" alt="" width="100px" height="100px"
            style="border-radius: 50%;border: 3px solid #000;margin-bottom: 20px;">
          <ul class="footer__list">
            <li class="footer__item">
              <p><i class="fas fa-search-location footer__item-icon"></i> Ho Chi Minh, Viet Nam</p>
            </li>
            <li class="footer__item">
              <p><i class="fas fa-phone-square-alt footer__item-icon"></i> Phone: <a
                  href="tel:0123456789">0123456789</a></p>
            </li>
            <li class="footer__item">
              <p><i class="fas fa-envelope-square footer__item-icon"></i> Email: <a
                  href="mailto:abc@gmail.com">abc@gmail.com</a></p>
            </li>
            <li>
              <a href=""><i class="fab fa-facebook" style="font-size: 24px; margin-right: 10px"></i></a>
              <a href=""><i class="fab fa-instagram" style="font-size: 24px; margin-right: 10px;color: pink;"></i></a>
              <a href=""><i class="fab fa-youtube" style="font-size: 24px; margin-right: 10px;color: red;"></i></a>
              <a href=""><i class="fab fa-twitter" style="font-size: 24px; margin-right: 10px"></i></a>
            </li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <div style="display: flex;justify-content:space-between;cursor: pointer;margin-bottom: 8px;"
            data-toggle="collapse" data-target="#demo2">
            <h3 class="footer__heading">Thông tin của chúng tôi</h3><i class="fas fa-chevron-down checkdl1"></i>
          </div>
          <ul class="footer__list collapse show" id="demo2">
            <li class="footer__item">
              <a href="" class="footer__item--link">Cơ sở 1: 26 Đường D1, P12, Quận Tân Bình, TP.HCM</a>
            </li>
            <li class="footer__item">
              <a href="" class="footer__item--link">Cơ sở 2: 86 Đinh Bộ Lĩnh, P10, Quận Bình Thanh, TP.HCM</a>
            </li>
            <li class="footer__item">
              <a href="" class="footer__item--link">Lĩnh vực kinh doanh</a>
            </li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <div style="display: flex;justify-content:space-between;cursor: pointer;margin-bottom: 8px;"
            data-toggle="collapse" data-target="#demo1">
            <h3 class="footer__heading">Chính sách</h3><i class="fas fa-chevron-down checkdl1"></i>
          </div>
          <ul class="footer__list collapse show" id="demo1">
            <li class="footer__item">
              <a href="" class="footer__item--link">Chính sách bảo hành</a>
            </li>
            <li class="footer__item">
              <a href="" class="footer__item--link">Chính sách đổi trả</a>
            </li>
            <li class="footer__item">
              <a href="" class="footer__item--link">Chính sách thanh toán</a>
            </li>
            <li class="footer__item">
              <a href="" class="footer__item--link">Chính sách giao nhận hàng</a>
            </li>
            <li class="footer__item">
              <a href="" class="footer__item--link">Chính sách bảo mật</a>
            </li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3">
          <div style="display: flex;justify-content:space-between;cursor: pointer;margin-bottom: 8px;"
            data-toggle="collapse" data-target="#demo">
            <h3 class="footer__heading">Hỗ trợ chung</h3><i class="fas fa-chevron-down checkdl1"></i>
          </div>
          <ul class="footer__list collapse show" id="demo">
            <li class="footer__item">
              <a href="./index.html" class="footer__item--link">Trang chủ</a>
            <li class="footer__item">
              <a href="./intro.html" class="footer__item--link">Giới thiệu</a>
            </li>
            <li class="footer__item">
              <a href="./Product.html" class="footer__item--link">Sản phẩm</a>
            </li>
            <li class="footer__item">
              <a href="./news.html" class="footer__item--link">Tin tức</a>
            </li>
            <li class="footer__item">
              <a href="./contact.html" class="footer__item--link">Liên hệ</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer__bottom">
      <p class="footer__text">© Bản quyền thuộc về P&T Shop</p>
    </div>
  </footer>
  <div id="go-to-top">
    <a class="btn-gototop"><i class="fas fa-arrow-up"></i></a>
  </div>
  <!-- end footer -->

</body>
<script src="./assets/js/validator.js"></script>
<script src="./assets/js/main.js"></script>
<script>
  Validator({
    form: '#form-1',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
      Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ'),
      Validator.isRequired('#email'),
      Validator.isEmail('#email'),
      Validator.minLength('#password', 6),
      Validator.isRequired('#password_confirmation'),
      Validator.isRequired('input[name="gender"]'),
      Validator.isConfirmed('#password_confirmation', function () {
        return document.querySelector('#form-1 #password').value;
      }, 'Mật khẩu nhập lại không chính xác')
    ],
    onSubmit: function (data) {
      // call api
      console.log(data);
    }
  });
</script>
<script>
  const pass_field = document.querySelector('#password');
  const show_btn = document.querySelector('.fa-eye')
  show_btn.addEventListener("click", function () {
    if (pass_field.type === "password") {
      pass_field.type = "text";
      show_btn.classList.add("hide");
    } else {
      pass_field.type = "password";
      show_btn.classList.remove("hide");
    }
  });
</script>
<script>
  const pass_field2 = document.querySelector('#password_confirmation');
  const show_btn2 = document.querySelector('.fa-eye-2')
  show_btn2.addEventListener("click", function () {
    if (pass_field2.type === "password") {
      pass_field2.type = "text";
      show_btn2.classList.add("hide");
    } else {
      pass_field2.type = "password";
      show_btn2.classList.remove("hide");
    }
  });
</script>

</html>