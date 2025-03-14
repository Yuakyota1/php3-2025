@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="text-center">Chỉnh sửa kích thước</h2>
    <form action="{{ route('admin.size.update', $size->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="size_name" class="form-label">Tên kích thước</label>
            <input type="text" class="form-control" id="size_name" name="size_name" value="{{ $size->size_name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.size.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
