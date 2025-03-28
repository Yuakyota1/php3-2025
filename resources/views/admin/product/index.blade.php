@extends('admin.layout')

@section('content')

<div class="container">
    <h2 class="text-center">Danh sách sản phẩm</h2>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Tìm kiếm sản phẩm...">
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục con</th>
                <th>thương hiệu</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="product-list">
            @foreach ($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->id }}</td>
                <td class="product-name">{{ $product->product_name }}</td>
                <td>{{ $product->subCategory->subcategory_name ?? 'Chưa có danh mục' }}</td>
                <td>{{ $product->brand->name ?? 'Chưa có thương hiệu' }}</td>
                <td>{{ Str::limit($product->description, 50) }}</td>
                <td>
                    @if($product->images)
                    @php
                    $images = json_decode($product->images, true);
                    @endphp
                    @if(is_array($images) && count($images) > 0)
                    @foreach($images as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Ảnh sản phẩm" width="50" height="50">
                    @endforeach
                    @endif
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <button class="btn btn-danger btn-sm delete-product" data-id="{{ $product->id }}">Xóa</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $products->links('vendor.pagination.bootstrap-5') }}
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            title: 'Thành công!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            title: 'Lỗi!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', function () {
                let productId = this.getAttribute('data-id');
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
                        fetch(`{{ url('admin/product') }}/${productId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Đã xóa!', 'Sản phẩm đã bị xóa.', 'success');
                                location.reload();
                            } else {
                                Swal.fire('Lỗi!', 'Không thể xóa sản phẩm.', 'error');
                            }
                        });
                    }
                });
            });
        });

        // Tìm kiếm sản phẩm
        document.getElementById('search').addEventListener('keyup', function () {
            let searchText = this.value.toLowerCase();
            document.querySelectorAll('#product-list tr').forEach(row => {
                let productName = row.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
