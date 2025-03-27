<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </head>

</head>
@yield('scripts')

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white vh-100 p-3" style="width: 250px;">
            <h4 class="text-center">Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/" class="nav-link text-white"> Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" data-bs-toggle="collapse" href="#categoryMenu" role="button" aria-expanded="false" aria-controls="categoryMenu">
                        📂 Quản lý danh mục ▼
                    </a>
                    <div class="collapse" id="categoryMenu">
                        <ul class="nav flex-column pl-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.category.index') }}" class="nav-link text-white">📁 Danh mục cha</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.subcategory.index') }}" class="nav-link text-white">📂 Danh mục con</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.brands.index') }}" class="nav-link text-white">📂Quản lý thương hiệu </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
    <a class="nav-link text-white" data-bs-toggle="collapse" href="#productMenu" role="button" aria-expanded="false" aria-controls="productMenu">
        📦 Quản lý sản phẩm ▼
    </a>
    <div class="collapse" id="productMenu">
        <ul class="nav flex-column pl-3">
            <li class="nav-item">
                <a href="{{ route('admin.product.index') }}" class="nav-link text-white">📂 Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.size.index') }}" class="nav-link text-white">📏 Kích thước</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.product_size_color.index') }}" class="nav-link text-white">🎨 Màu sắc</a>
            </li>
        </ul>
    </div>
</li>

                <li>
                    <a href="{{ route('admin.users.index') }}" class="nav-link text-white">📂Quản lý người dùng</a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link text-white">📂Quản lý đơn hàng</a>
                </li>
                <li>
                    <a href="{{ route('admin.coupon.index') }}" class="nav-link text-white">📂Quản lý mã giảm giá</a>
                </li>
                <li>
                    <a href="{{ route('admin.banner.index') }}" class="nav-link text-white">📂Quản lý Banner</a>
                </li>
                <li>
                    <a href="{{ route('admin.blog.index') }}" class="nav-link text-white">📂Quản lý bài viết</a>
                </li>
                <li>
                    <a href="{{ route('admin.post_category.index') }}" class="nav-link text-white">📂Quản lý danh mục bài viết</a>
                </li>
            </ul>
        </nav>

        <!-- Nội dung chính -->
        <div class="container-fluid p-4" style="flex-grow: 1;">
            @yield('content') {{-- Đây là nơi sẽ thay đổi nội dung --}}
        </div>
    </div>

</body>

</html>