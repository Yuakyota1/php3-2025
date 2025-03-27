@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Chỉnh sửa người dùng</h2>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>Mật khẩu (bỏ trống nếu không đổi):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <div class="mb-3">
            <label>Vai trò:</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Trạng thái:</label>
            <select name="status" class="form-control">
                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Bị khóa</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ảnh đại diện:</label>
            <input type="file" name="image" class="form-control">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Hình ảnh" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
