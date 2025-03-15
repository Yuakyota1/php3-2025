@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Danh sách danh mục bài viết</h2>
    <a href="{{ route('admin.post_category.create') }}" class="btn btn-success mb-3">Thêm danh mục</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name_postcategory }}</td>
                <td>
                    <a href="{{ route('admin.post_category.edit', $category->id) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                    <form action="{{ route('admin.post_category.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
   
</div>
@endsection
