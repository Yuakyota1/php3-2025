@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Danh sách người dùng</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Thêm người dùng</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('default.png') }}" alt="Hình ảnh"
                        width="60">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                <td>
                    <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : 'secondary' }}">
                        {{ $user->role == 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $user->status ? 'success' : 'warning' }}">
                        {{ $user->status ? 'Hoạt động' : 'Bị khóa' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
