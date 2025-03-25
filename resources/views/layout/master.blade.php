@include('layout.head')
@include('layout.header')

<div class="main-content">
    @yield('content') {{-- Load nội dung từ các view con --}}
</div>

@include('layout.footer')
