@include('layout.head')
@include('layout.header')

<div class="container mt-4">
    <h2 class="text-center">Danh Sách Địa Chỉ</h2>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Thêm Địa Chỉ Mới</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Tên</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Mặc định</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($addresses as $address)
            <tr>
                <td>{{ $address->full_name }}</td>
                <td>{{ $address->phone }}</td>
                <td>{{ $address->address_line1 }}, {{ $address->city }} {{ $address->state }}, {{ $address->zip_code }}, {{ $address->country }}</td>
                <td>{{ $address->is_default ? '✔' : '' }}</td>
                <td>
                    <a href="{{ route('addresses.edit', $address) }}" class="btn btn-warning">Sửa</a>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $address->id }})">Xóa</button>

                    <form id="delete-form-{{ $address->id }}" action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display: none;">
                        @csrf @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   function confirmDelete(addressId) {
    Swal.fire({
        title: "Bạn có chắc chắn muốn xóa?",
        text: "Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + addressId).submit();
        }
    });
}

</script>



