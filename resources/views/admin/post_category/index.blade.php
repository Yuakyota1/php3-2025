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
            <tr id="row-{{ $category->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name_postcategory }}</td>
                <td>
                    <a href="{{ route('admin.post_category.edit', $category->id) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                    <button class="btn btn-danger btn-sm delete-category" data-id="{{ $category->id }}">Xóa</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<!-- Thêm thư viện SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-category').forEach(button => {
            button.addEventListener('click', function () {
                let categoryId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Hành động này không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Xóa",
                    cancelButtonText: "Hủy",
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`{{ url('admin/post_category') }}/${categoryId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire("Đã xóa!", "Danh mục đã bị xóa.", "success");
                                document.getElementById(`row-${categoryId}`).remove();
                            } else {
                                Swal.fire("Lỗi!", "Không thể xóa danh mục.", "error");
                            }
                        });
                    }
                });
            });
        });
    });
</script>
@endsection
