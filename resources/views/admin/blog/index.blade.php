@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Danh sách bài viết</h2>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Thêm bài viết</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Danh mục</th> <!-- Cột danh mục -->
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $blog->title }}</td>
                <td><img src="{{ asset('storage/' . $blog->image) }}" width="100" alt="Hình ảnh bài viết"></td>
                <td>{{ $blog->category->name_postcategory ?? 'Chưa có danh mục' }}</td> <!-- Hiển thị danh mục -->
                <td>{{ $blog->status }}</td>
                <td>
                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
</div>
@endsection
