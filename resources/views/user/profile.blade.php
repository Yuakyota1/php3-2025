@include('layout.head')
@include('layout.header')

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded">
        <h2 class="text-center mb-4">Thông tin tài khoản</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : 'https://via.placeholder.com/150' }}"
                    class="rounded-circle mb-3"
                    alt="User Avatar"
                    style="width: 120px; height: 120px; object-fit: cover;">

                <h4>{{ auth()->user()->name }}</h4>
                <p class="text-muted">{{ auth()->user()->role == 'admin' ? 'Quản trị viên' : 'Người dùng' }}</p>
                <p><strong>Số điện thoại:</strong> {{ auth()->user()->phone ?? 'Chưa cập nhật' }}</p>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-right">Tên:</th>
                        <td>{{ auth()->user()->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Email:</th>
                        <td>{{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Vai trò:</th>
                        <td>
                            <span class="badge badge-{{ auth()->user()->role == 'admin' ? 'danger' : 'secondary' }}">
                                {{ auth()->user()->role == 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Trạng thái:</th>
                        <td>
                            <span class="badge badge-{{ auth()->user()->status ? 'success' : 'warning' }}">
                                {{ auth()->user()->status ? 'Hoạt động' : 'Tạm khóa' }}
                            </span>
                        </td>
                    </tr>
                </table>
                <div class="text-right mt-3">
                    <a href="{{ route('user.edit', auth()->user()->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Chỉnh sửa thông tin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')