@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Thêm kích thước</h2>
    <form action="{{ route('admin.size.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="size_name" class="form-label">Tên kích thước</label>
            <input type="text" class="form-control" id="size_name" name="size_name" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('admin.size.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session("success") }}',
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: '{{ $errors->first() }}',
        });
    @endif
</script>
@endsection
