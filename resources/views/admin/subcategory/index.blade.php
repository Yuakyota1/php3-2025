@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Danh sách danh mục con</h2>
    <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary mb-3">Thêm danh mục con</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục con</th>
                <th>Danh mục cha</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $key => $subcategory)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $subcategory->subcategory_name }}</td>
                    <td>{{ $subcategory->category->category_name ?? 'Không có' }}</td>
                    <td>
                        <a href="{{ route('admin.subcategory.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.subcategory.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
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
