@extends('layouts.app')

@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
    <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row">
            @foreach(session('cart') as $item)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if(isset($item['image']))
                                    @php
                                        $images = json_decode($item['image'], true);
                                    @endphp
                                    @if(is_array($images) && count($images) > 0)
                                        <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $item['name'] }}" class="img-fluid rounded-start" style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" class="img-fluid rounded-start" style="height: 200px; object-fit: cover;">
                                    @endif
                                @else
                                    <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" class="img-fluid rounded-start" style="height: 200px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title product-name">{{ $item['name'] }}</h5>
                                    <p class="card-text">Giá: <strong>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</strong></p>
                                    <p class="card-text">Số lượng: 
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-inline-flex">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control w-25 me-2" required min="1">
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></button>
                                        </form>
                                    </p>
                                    <p class="card-text">Tổng: <strong>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</strong></p>
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="d-flex justify-content-end">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-4">
            <h4>Tổng giá trị: 
                <span class="fw-bold text-danger">
                    {{ number_format(array_sum(array_map(function($item) {
                        return $item['price'] * $item['quantity'];
                    }, session('cart'))), 0, ',', '.') }} VNĐ
                </span>
            </h4>
        </div>
        
        <div class="d-flex justify-content-start">  <!-- Chuyển justify-content từ "end" sang "start" -->
            <form action="{{ route('user.checkout.confirm') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
            </form>
        </div>
    @else
        <div class="alert alert-info text-center">
            Giỏ hàng của bạn đang trống.
        </div>
    @endif
</div>

@endsection

@push('styles')
<style>
    .product-name {
        height: 50px;  /* Giới hạn chiều cao của tên sản phẩm */
        overflow: hidden;  /* Ẩn phần văn bản vượt quá */
        text-overflow: ellipsis;  /* Thêm dấu "..." nếu văn bản quá dài */
        white-space: nowrap;  /* Đảm bảo văn bản không xuống dòng */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card {
        display: flex;
        flex-direction: row;
        height: 250px;  /* Giới hạn chiều cao khung sản phẩm */
        box-sizing: border-box;
    }

    .card-body p {
        font-size: 14px;
        margin-bottom: 10px;
    }
</style>
@endpush
