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
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $item)
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
                            <td class="align-middle">{{ $item['name'] }}</td>
                            
                            <td class="align-middle">
                                @if(isset($item['id'])) 
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="form-control w-50 me-2" required min="1">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                          </svg>
                                    </button>
                                </form>
                                @else
                                    <span>Không có thông tin sản phẩm</span>
                                @endif
                            </td>
                            <td class="align-middle">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                            <td class="align-middle">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                            <td class="align-middle">
                                @if(isset($item['id']))
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                @else
                                    <span>Không thể xóa sản phẩm</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end my-4">
            <h4>Tổng giá trị: 
                <span class="fw-bold text-danger">
                    {{ number_format(array_sum(array_map(function($item) {
                        return $item['price'] * $item['quantity'];
                    }, session('cart'))), 0, ',', '.') }} VNĐ
                </span>
            </h4>
        </div>
        
        <div class="d-flex justify-content-end">
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
