@extends('layout.master') {{-- Kế thừa layout chính --}}

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Danh sách yêu thích</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="row">
    @foreach ($favorites as $favorite)
    @php
        $images = json_decode($favorite->product->images, true);
        $firstImage = !empty($images) ? $images[0] : 'default.jpg'; // Nếu không có ảnh thì dùng ảnh mặc định
    @endphp
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top" alt="{{ $favorite->product->product_name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $favorite->product->product_name }}</h5>
                <p class="card-text">{{ $favorite->product->description }}</p>
                <a href="{{ url('product/detail/' . $favorite->product->id) }}" class="btn btn-primary">Xem chi tiết</a>

                <form action="{{ url('/favorites/' . $favorite->product->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Xóa</button>
</form>

            </div>
        </div>
    </div>
@endforeach

    </div>
</div>
@endsection
