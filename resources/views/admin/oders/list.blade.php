@extends('admin.layouts.app')
@section('content')
    <div class="page-body-wrapper">


        <!-- Order section Start -->
        <div class="page-body">
            <div class="title-header">
                <h5>Order List</h5>
            </div>

            <!-- Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="table-responsive table-desi">
                                        <table class="table table-striped all-package">
                                            <thead>
                                                <tr>
                                                    <th>Order Image</th>
                                                    <th>Order Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $subTotal = 0;
                                                @endphp
                                                @foreach ($groupedCart as $productId => $items)
                                                    @php
                                                        $orderDetail = $items->first();
                                                        $totalQuantity = $items->sum('quantity');
                                                        $subTotal = $totalQuantity * $orderDetail->product->price;
                                                        $inputId = 'cartInput_' . $productId;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <img src={{ $orderDetail->product->image }} alt="users">
                                                            </span>
                                                        </td>

                                                        <td>{{ $orderDetail->product->name }}</td>

                                                        <td>{{ number_format($orderDetail->product->price, 2) }}</td>

                                                        <td>× {{ $totalQuantity }}</td>

                                                        {{-- <td class="order-success">
                                                            <span>Success</span>
                                                        </td>

                                                        <td>$15</td> --}}

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="order-detail.html">
                                                                        <span class="lnr lnr-eye"></span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <span class="lnr lnr-pencil"></span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)">
                                                                        <span class="lnr lnr-trash"></span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination Box Start -->
                            <div class=" pagination-box">
                                <nav class="ms-auto me-auto " aria-label="...">
                                    <ul class="pagination pagination-primary">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:void(0)">Previous</a>
                                        </li>

                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0)">1</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">2</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">3</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0)">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Pagination Box End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- footer start-->
            <div class="container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2021 © Voxo theme by pixelstrap</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Order section End -->
    </div>
@endsection
