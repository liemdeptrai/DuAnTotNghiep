@extends('layout')

@section('content')

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots">
                            
                        </div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w">
                            
                        </div>
                    
                        <div>
                            @if ($images && (is_array($images) || is_object($images)))
                                <!-- Ảnh lớn -->
                                <div style="text-align: center;">
                                    <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->name }}" style="max-width: 100%; height: auto;">
                                </div>
                                
                                <!-- Ảnh nhỏ -->
                                <div class="row mt-2">
                                    @foreach ($images as $image)
                                        <div class="col-4">
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" style="width: 100%; height: auto;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Không có hình ảnh nào.</p>
                            @endif
                        </div>
                        
                    </div>
                        
                </div>
            </div>
                
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{-- {{ $product->name }} --}}<h2>{{ $product->name }}</h2>
                    </h4>

                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-203 flex-c-m respon6">
                            Giá cũ
                        </div>
                    
                        <div class="size-204 respon6-next">
                            <span class="old-price" style="text-decoration: line-through;">{{ number_format($product->price) }}<small> VND</small></span>
                        </div>
                    </div>
                    
                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-203 flex-c-m respon6">
                            Giá sale
                        </div>
                    
                        <div class="size-204 respon6-next">
                            <span class="new-price" style="color:red;">{{ number_format($product->price - ($product->price * ($product->sale_percentage / 100))) }}<small> VND</small></span>
                        </div>
                    </div>

                    
                    
                    <!--  -->
                    <div class="p-t-33">
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Size
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="time">
                                        <option>Choose an option</option>
                                        <option>Size S</option>
                                        <option>Size M</option>
                                        <option>Size L</option>
                                        <option>Size XL</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Color
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="time">
                                        <option>Choose an option</option>
                                        <option>Red</option>
                                        <option>Blue</option>
                                        <option>White</option>
                                        <option>Grey</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>
                                <form id="addToCartForm" action="{{ route('cart.add', ['itemId' => $product->id, 'quantity' => 1]) }}" method="POST">
                                    @csrf
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                    </div>
                                </form>
                                <div class="mt-3 advantage-box">
                                    <h5 style="color:aliceblue;">Ưu Đãi Của Shop</h5>
                                    <p>✔ Giảm giá 10% cho đơn hàng đầu tiên</p>
                                    <p>✔ Miễn phí vận chuyển cho đơn hàng từ 500.000 VND</p>
                                    <p>✔ Quà tặng kèm cho khách hàng thân thiết</p>
                                    <p>✔ Hỗ trợ trả góp 0% lãi suất khi đến tận cửa hàng</p>
                                </div>
                            </div>
                        </div>	
                    </div>

                    <!--  -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <h3 class="mtext-108 cl2" >Mô Tả Sản Phẩm</h3>
                            <p>{!! nl2br(e($product->content)) !!}</p>
                        </div>

                    </div>
                </ul>

            
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <style>
    .advantage-box {
        background-color: #FF0000;
        border: 2px solid black; /* Viền đen */
        padding: 1rem; /* Thêm khoảng cách bên trong */
        border-radius: 0.5rem; /* Bo góc */
        color: white; /* Chữ màu trắng */
    }
        </style>
</section>


<!-- Related Products -->


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/scripts.js') }}">
    $(document).ready(function(){
        $('.slick3').slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    });</script>


@endsection
