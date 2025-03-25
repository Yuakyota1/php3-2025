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
                    <button class="btn btn-danger btn-sm delete-category" data-id="{{ $category->id }}">Xóa</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-category').forEach(button => {
            button.addEventListener('click', function () {
                let categoryId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: 'Hành động này không thể hoàn tác!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`{{ route('admin.category.destroy', '') }}/${categoryId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Đã xóa!', 'Danh mục đã bị xóa.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Lỗi!', 'Không thể xóa danh mục.', 'error');
                            }
                        });
                    }
                });
            });
        });
    });
</script>
@endsection
