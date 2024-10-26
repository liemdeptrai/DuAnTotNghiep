@extends('layout')

@section('content')
<form class="bg0 p-t-75 p-b-85">
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <h2 class="text-center mb-4">Thông tin thanh toán</h2>

    <form action="{{ route('user.checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Customer Information -->
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ tên của bạn" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" required>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="payment-method">Phương thức thanh toán</label>
                    <button type="button" class="btn btn-outline-primary btn-block" onclick="togglePaymentOptions()">Chọn phương thức thanh toán</button>
                </div>
                <div id="payment-options" class="mt-3" style="display: none;">
                    <div class="form-check mb-2">
                        <input type="radio" name="payment_method" id="cod" value="cod" class="form-check-input" onclick="togglePaymentDetails('cod')" required>
                        <label for="cod" class="form-check-label">Thanh toán khi nhận hàng (COD)</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="radio" name="payment_method" id="qr" value="qr" class="form-check-input" onclick="togglePaymentDetails('qr')" required>
                        <label for="qr" class="form-check-label">Thanh toán bằng QR Code</label>
                    </div>
                </div>
                
                <!-- Payment Details -->
                <div id="payment-details-cod" class="payment-details mt-3" style="display: none;">
                    <div class="alert alert-info">
                        Thanh toán trực tiếp cho người giao hàng. Chỉ áp dụng cho đơn hàng nội địa.
                    </div>
                </div>
                <div id="payment-details-qr" class="payment-details mt-3" style="display: none;">
                    <div class="alert alert-info">
                        Quét mã QR bằng ứng dụng ngân hàng của bạn.
                        <img src="{{ asset('img/QR.jpg') }}" alt="QR Code" class="img-fluid mt-2" style="max-width: 200px;">
                        <p class="mt-2">Vui lòng hoàn thành thanh toán trong 15 phút.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Giỏ hàng của bạn</h4>
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td class="align-middle text-center">
                                    @if(isset($item['image']))
                                        @php
                                            $images = json_decode($item['image'], true);
                                        @endphp
                                        @if(is_array($images) && count($images) > 0)
                                            <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $item['name'] }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                        @else
                                            <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" class="img-thumbnail" style="width: 100px; height: auto;">
                                        @endif
                                    @else
                                        <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" class="img-thumbnail" style="width: 100px; height: auto;">
                                    @endif
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Display Total Price -->
                <div class="text-right">
                    <h4>Tổng giá trị đơn hàng: <span class="fw-bold text-danger">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</span></h4>
                </div>

                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    function togglePaymentOptions() {
        const paymentOptions = document.getElementById('payment-options');
        paymentOptions.style.display = paymentOptions.style.display === 'none' ? 'block' : 'none';
    }

    function togglePaymentDetails(method) {
        document.getElementById('payment-details-cod').style.display = 'none';
        document.getElementById('payment-details-qr').style.display = 'none';

        if (method === 'cod') {
            document.getElementById('payment-details-cod').style.display = 'block';
        } else if (method === 'qr') {
            document.getElementById('payment-details-qr').style.display = 'block';
        }
    }
</script>
</form>
@endsection
