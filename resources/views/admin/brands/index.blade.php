@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Danh sách thương hiệu</h2>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">Thêm thương hiệu</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên thương hiệu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $key => $brand)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $brand->name }}</td>
                <td>
                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <button class="btn btn-danger btn-sm delete-brand" data-id="{{ $brand->id }}">Xóa</button>
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
        document.querySelectorAll('.delete-brand').forEach(button => {
            button.addEventListener('click', function () {
                let brandId = this.getAttribute('data-id');
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
                        fetch(`{{ route('admin.brands.destroy', '') }}/${brandId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Đã xóa!', 'Thương hiệu đã bị xóa.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Lỗi!', 'Không thể xóa thương hiệu.', 'error');
                            }
                        });
                    }
                });
            });
        });
    });
</script>
@endsection
