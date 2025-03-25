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
                <tr id="subcategory-{{ $subcategory->id }}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $subcategory->subcategory_name }}</td>
                    <td>{{ $subcategory->category->category_name ?? 'Không có' }}</td>
                    <td>
                        <a href="{{ route('admin.subcategory.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $subcategory->id }})">Xóa</button>

                        <!-- Form ẩn để gửi request xóa -->
                        <form id="delete-form-{{ $subcategory->id }}" action="{{ route('admin.subcategory.destroy', $subcategory->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Thêm thư viện SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(subcategoryId) {
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Hành động này sẽ không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${subcategoryId}`).submit();
            }
        });
    }
</script>

@endsection
