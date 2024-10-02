@extends('layouts.app')
@section('content')
    <section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
        <div class="container">
            <h2>checkout</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="shop-4column.html">shop grid</a></li>
                <li class="breadcrumb-item active" aria-current="page">checkout</li>
            </ol>
        </div>
    </section>
    <section class="inner-section checkout-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert-info">
                        <p>Returning customer? <a href="login.html">Click here to login</a></p>
                    </div>
                    @php
                        $subTotal = 0;
                    @endphp
                </div>
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>Your order</h4>
                        </div>
                        <div class="account-content">
                            <div class="table-scroll">
                                <table class="table-list">
                                    <thead>
                                        <tr>
                                            <th scope="col">Serial</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedCart as $productId => $items)
                                            @php
                                                $orderDetail = $items->first();
                                                $totalQuantity = $items->sum('quantity');
                                                $subTotal += $totalQuantity * $orderDetail->product->price;
                                            @endphp
                                            <tr>
                                                <td class="table-serial">
                                                    <h6>01</h6>
                                                </td>
                                                <td class="table-image"><img src={{ $orderDetail->product->image }} alt="product"></td>
                                                <td class="table-name">
                                                    <h6>{{ $orderDetail->product->name }}</h6>
                                                </td>
                                                <td class="table-price">
                                                    <h6>{{ number_format($orderDetail->product->price, 2) }}</h6>
                                                </td>
                                                <td class="table-quantity">
                                                    <h6>× {{ $totalQuantity }}</h6>
                                                </td>
                                                <td class="table-action">
                                                    <form action="{{ route('cart.destroy', ['id' => $orderDetail->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                                    </form>
                                                </td>                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="chekout-coupon"><button class="coupon-btn">Do you have a coupon code?</button>
                                <form class="coupon-form"><input type="text" placeholder="Enter your coupon code"><button type="submit"><span>apply</span></button></form>
                            </div>
                            <div class="checkout-charge">
                                <ul>
                                    <li><span>Total<small></small>:</span><span>{{ number_format($subTotal, 2) }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-proced"><a href={{ route('user.checkoutpass')}} class="btn btn-inline">proced to checkout</a></div>
            </div>
        </div>
    </section>
@endsection
