@include('layout.head')
@include('layout.header')

<div class="container mt-5">
    <h2 class="mb-4">Chỉnh sửa thông tin cá nhân</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ auth()->user()->phone }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh đại diện</label>
            <input type="file" name="image" id="image" class="form-control">
            @if(auth()->user()->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Avatar" width="100">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('user.profile') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

@include('layout.footer')
