@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Danh sách danh mục</h2>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Thêm danh mục</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $category)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline;">
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
