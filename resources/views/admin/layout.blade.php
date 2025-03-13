<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white vh-100 p-3" style="width: 250px;">
            <h4 class="text-center">Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}" class="nav-link text-white">📂 Quản lý danh mục</a>
                </li>
                <li>
                    <a href="{{ route('admin.subcategory.index') }}" class="nav-link text-white">📂Quản lý danh mục con </a>
                </li>
            </ul>
        </nav>

        <!-- Nội dung chính -->
        <div class="container-fluid p-4" style="flex-grow: 1;">
            @yield('content')  {{-- Đây là nơi sẽ thay đổi nội dung --}}
        </div>
    </div>

</body>

</html>
