@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Danh sách kích thước</h2>
    <a href="{{ route('admin.size.create') }}" class="btn btn-primary mb-3">Thêm kích thước</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên kích thước</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sizes as $key => $size)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $size->size_name }}</td>
                <td>
                    <a href="{{ route('admin.size.edit', $size->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.size.destroy', $size->id) }}" method="POST" style="display: inline-block;">
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
