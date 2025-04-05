@include('layout.head')
@include('layout.header')

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded">
        <h2 class="text-center mb-4">Chỉnh Sửa Địa Chỉ</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('addresses.update', $address->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="full_name">Họ và Tên:</label>
                <input type="text" id="full_name" name="full_name" class="form-control" value="{{ old('full_name', $address->full_name) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $address->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="address_line1">Đường / Số nhà:</label>
                <input type="text" id="address_line1" name="address_line1" class="form-control" value="{{ old('address_line1', $address->address_line1) }}" required>
            </div>

            <div class="form-group">
                <label for="city">Thành phố:</label>
                <select id="city" name="city" class="form-control" required>
                    <option value="">Chọn thành phố</option>
                    @foreach ($cities as $city)
                    <option value="{{ $city }}" {{ $address->city == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="state">Tỉnh:</label>
                <select id="state" name="state" class="form-control">
                    <option value="">Chọn tỉnh</option>
                    @foreach ($states as $state)
                    <option value="{{ $state }}" {{ $address->state == $state ? 'selected' : '' }}>{{ $state }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="zip_code">Mã bưu điện:</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control" value="{{ old('zip_code', $address->zip_code) }}" required>
            </div>

            <div class="form-group">
                <label for="country">Quốc gia:</label>
                <select id="country" name="country" class="form-control" required>
                    @foreach ($countries as $country)
                    <option value="{{ $country }}" {{ $address->country == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_default" name="is_default" value="1" {{ $address->is_default ? 'checked' : '' }}>
                <label class="form-check-label" for="is_default">
                    Đặt làm địa chỉ mặc định
                </label>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Cập Nhật Địa Chỉ</button>
                <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Quay Lại</a>
            </div>
        </form>
    </div>
</div>

@include('layout.footer')