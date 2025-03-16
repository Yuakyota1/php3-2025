<header class="header">
  <div class="container">
    <div class="top-link clearfix hidden-sm hidden-xs">
      <div class="row">
        <div class="col-12 login_link">
          <ul class="header_link right m-auto">
            @guest
            <li>
              <a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt mr-3"></i>Đăng nhập</a>
            </li>
            <li>
              <a href="{{ url('/register') }}"><i class="fas fa-user-plus mr-3" style="margin-left: 10px;"></i>Đăng kí</a>
            </li>
            @else
          </ul>
          <ul class="nav nav__first right">
            <li class="nav-item nav-item__first nav-item__first-user">
              <img src="./assets/img/product/noavatar.png" alt="" class="nav-item__first-img">
              <span class="nav-item__first-name">{{ Auth::user()->name }}</span>
              <ul class="nav-item__first-menu">
                @auth
                @if (Auth::user()->role == 'admin')
                <li class="nav-item__first-item">
                  <a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a>
                </li>
                @endif
                @endauth

                <li class="nav-item__first-item">
                  <a href="">Tài khoản của tôi</a>
                </li>
                <li class="nav-item__first-item">
                  <a href="">Địa chỉ của tôi</a>
                </li>
                <li class="nav-item__first-item">
                  <a href="">Đơn mua</a>
                </li>
                <form class="nav-item__first-item" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                <li class="nav-item__first-item">

                  <a class="nav-item__first-item" href="#" onclick="document.getElementById('logout-form').submit();">Đăng xuất</a>
                </li>

              </ul>
            </li>
          </ul>
          @endguest
        </div>

      </div>
    </div>
    <div class="header-main clearfix">
      <div class="row">
        <div class="col-lg-3 col-100-h">
          <div id="trigger-mobile" class="visible-sm visible-xs"><i class="fas fa-bars"></i></div>
          <div class="logo">
            <a href="/">
              <img src="./assets/img/logo/logomain.png" alt="">
            </a>
          </div>
          <div class="mobile_cart visible-sm visible-xs">
            <a href="./cart" class="header__second__cart--icon">
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
            <a href="./cart" class="header__second__cart--icon">
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
          <a href="./product">Sản phẩm<i class="fas fa-angle-right" style="margin-left: 5px;"></i></a>
          <div class="mega-content" style="overflow-x: hidden;">
            <div class="row">
              <ul class="col-8 no-padding level0">
                <li class="level1">
                  <a class="hmega" href="./product">Tất cả sản phẩm</a>
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