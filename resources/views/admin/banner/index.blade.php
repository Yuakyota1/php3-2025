@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Danh sách Banners</h2>
    <a href="{{ route('admin.banner.create') }}" class="btn btn-primary mb-3">Thêm Banner</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $key => $banner)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img src="{{ asset('storage/' . $banner->image) }}" width="100"></td>
                <td>{{ $banner->title }}</td>
                <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
                <td>{{ $banner->status ? 'Hiển thị' : 'Ẩn' }}</td>
                <td>
                    <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" style="display:inline;">
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
