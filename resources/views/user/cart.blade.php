@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Giỏ hàng của bạn</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table">
            <thead>
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
                        <td>
                            @if(isset($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 100px; height: auto;">
                            @else
                                <img src="{{ asset('path/to/default-image.jpg') }}" alt="Ảnh không có" style="width: 100px; height: auto;">
                            @endif
                        </td>
                        <td>{{ $item['name'] }}</td>
                        
                        <td>
                            @if(isset($item['id'])) 
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" required min="1">
                                <button type="submit" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg></button>
                            </form>
                            @else
                                <span>Không có thông tin sản phẩm</span>
                            @endif
                        </td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td> <!-- giá -->
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td> <!-- tổng giá -->
                        <td>
                            @if(isset($item['id']))
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            @else
                                <span>Không thể xóa sản phẩm</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>

        <h4>Tổng giá trị: 
            {{ number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, session('cart'))), 0, ',', '.') }} VNĐ
        </h4>
        
        <form action="{{ route('user.checkout.process') }}" method="POST">
            @csrf
            <!-- Các input khác -->
            <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
        </form>
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>

@endsection
