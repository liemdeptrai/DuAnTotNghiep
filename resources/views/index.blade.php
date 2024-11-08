@extends('layouts.app')

@section('content')
<section class="section recent-part">
    <div class="container">
        <!-- Banner -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/banner1.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/banner2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/banner3.jpg') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="special-offer" data-aos="fade-up" data-aos-duration="9000" style="display: flex; align-items: center; justify-content: space-between; background-color: #fff; padding: 50px; margin-bottom: 50px; border-radius: 10px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); border: 2px solid #ddd;">
            <div class="offer-text" style="flex: 1; padding-right: 20px;">
                <h2 style="color: #ff6600; font-size: 32px; font-weight: bold;">Ưu đãi đặc biệt khi mua hàng hôm nay</h2>
                <p style="font-size: 18px; color: #555;">Giao hàng miễn phí và nhận quà tặng bất ngờ cho tất cả đơn hàng trên 1,000,000 VND</p>
                <a href="shop-4column.html" class="btn btn-primary" style="padding: 15px 30px; font-size: 16px;">Mua ngay</a>
            </div>
            <div class="offer-image" style="flex: 1; text-align: right;">
                <img src="{{ asset('img/banner5.jpg') }}" alt="Ưu đãi đặc biệt" style="max-width: 100%; height: auto; border-radius: 10px;">
            </div>
        </div>

        













        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Recently Sold Items</h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-duration="1000" style="display: flex; flex-wrap: wrap; gap: 15px; justify-content: space-between;">
            @foreach ($products as $item)
                <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom: 15px;">
                    <div class="product-wrapper @if($item->quantity == 0) out-of-stock @endif"> <!-- Bao quanh sản phẩm và kiểm tra nếu hết hàng -->
                        <div class="product-media">
                            @if ($item->sale) 
                                <div class="product-label">
                                    <label class="label-text sale">Sale</label>
                                </div>
                            @endif
                            
                            <!-- Kiểm tra số lượng sản phẩm -->
                            @if ($item->quantity == 0)
                                <div class="product-label">
                                    <label class="label-text out-of-stock">Hết hàng</label> <!-- Nhãn hết hàng -->
                                </div>
                            @endif
        
                            <button class="product-wish wish"><i class="fas fa-heart"></i></button>
        
                            @if ($item->image)
                                @php
                                    $images = json_decode($item->image);
                                @endphp
                                @if (is_array($images) || is_object($images)) 
                                    @foreach ($images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Product Image" style="width: 100%; height: 250px;">
                                    @endforeach
                                @else
                                    <p>Invalid image data</p>
                                @endif
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
        
                        <div class="product-widget">
                            <a title="Product View" href="{{ route('products.show', $item->id) }}" class="fas fa-eye"></a>
                        </div>
        
                        <div class="product-content">
                            <h6 class="product-names">
                                <a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a>
                            </h6>
                            <h6 class="product-price">
                                @if ($item->sale_percentage)
                                    <span class="old-price" style="text-decoration: line-through;">
                                        {{ number_format($item->price, 0, ',', '.') }}<small> VND</small>
                                    </span>
                                    <br>
                                    <span class="new-price" style="color:red;">
                                        {{ number_format($item->price - ($item->price * ($item->sale_percentage / 100)), 0, ',', '.') }}<small> VND</small>
                                    </span>
                                @else
                                    <span>{{ number_format($item->price, 0, ',', '.') }}<small> VND</small></span>
                                @endif
                            </h6>
        
                            <div class="d-flex align-items-center">
                                <form id="addToCartForm" action="{{ route('cart.add', ['itemId' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary @if($item->quantity == 0) disabled @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                        </svg>
                                    </button>
                                </form>
        
                                <a title="Chi tiết sản phẩm" href="{{ route('products.show', $item->id) }}" class="btn btn-secondary ms-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                            </div> <!-- Kết thúc div chứa nút -->
                        </div>
                    </div> <!-- Kết thúc sản phẩm -->
                </div>
            @endforeach
        
            <div class="promotion-section">
                <h2>Giảm giá lên đến 50% cho các sản phẩm hot</h2>
                <p>Mua ngay hôm nay để nhận ưu đãi không thể bỏ qua!</p>
            </div>
        </div>
        @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        <div class="product-list">
        @if(isset($productsByCategory[$category->id]))
            @foreach($productsByCategory[$category->id] as $item)
                <div class="product-wrapper"> <!-- Bao quanh sản phẩm -->
                    <div class="product-media">
                        @if ($item->sale) 
                            <div class="product-label">
                                <label class="label-text sale">Sale</label>
                            </div>
                        @endif

                        <button class="product-wish wish"><i class="fas fa-heart"></i></button>

                        @if ($item->image)
                            @php
                                $images = json_decode($item->image);
                            @endphp
                            @if (is_array($images) || is_object($images)) 
                                @foreach ($images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Product Image" style="width: 250px; height: 250px;">
                                    @break <!-- Chỉ hiển thị hình ảnh đầu tiên -->
                                @endforeach
                            @else
                                <p>Invalid image data</p>
                            @endif
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                    <div class="product-widget">
                        <a title="Product View" href="{{ route('products.show', $item->id) }}" class="fas fa-eye"></a>
                    </div>
                    <div class="product-content">
                        <h6 class="product-names">
                            <a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a>
                        </h6>
                        <h6 class="product-price">
                            @if ($item->sale_percentage)
                                <span class="old-price" style="text-decoration: line-through; ">
                                    {{ number_format($item->price, 0, ',', '.') }}<small> VND</small>
                                </span>
                                <br>
                                <span class="new-price" style="color:red;">
                                    {{ number_format($item->price - ($item->price * ($item->sale_percentage / 100)), 0, ',', '.') }}<small> VND</small>
                                </span>
                            @else
                                <span>{{ number_format($item->price, 0, ',', '.') }}<small> VND</small></span>
                            @endif
                        </h6>
                        <div class="d-flex align-items-center"> <!-- Thêm align-items-center -->
                            <form id="addToCartForm" action="{{ route('cart.add', ['itemId' => $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                </button>
                            </form>
                            <a title="Chi tiết sản phẩm" href="{{ route('products.show', $item->id) }}" class="btn btn-secondary ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                            </a>
                        </div> <!-- Kết thúc div chứa nút -->
                    </div>
                </div> 
            @endforeach
        @else
            <p>Không có sản phẩm nào trong danh mục này.</p>
        @endif
    </div>
@endforeach
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25">
                    <a href="shop-4column.html" class="btn btn-outline">
                        <i class="fas fa-eye"></i><span>Show More</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    
    .carousel-inner {
    margin-bottom: 50px; /* Tạo khoảng cách giữa banner và Recently Sold Items */
    }
    .d-flex{
        margin-left: 49px;
    }
    .btn {
        margin-right: 10px; /* Khoảng cách giữa hai nút */
    }
    .product-wrapper {
        border: 1px solid #ddd; /* Đường viền cho ô sản phẩm */
        border-radius: 8px; /* Bo tròn góc */
        padding: 15px; /* Khoảng cách bên trong */
        transition: box-shadow 0.3s; /* Hiệu ứng khi hover */
    }

    .product-wrapper:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15); /* Hiệu ứng đổ bóng khi hover */
    }

    .product-label {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
    }

    .label-text.sale {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

.product-price {
    margin-top: 10px; 
    font-size: 16px;
    text-align: center;
}


.old-price {
    color: #999;
    margin-right: 10px; 
    text-decoration: line-through; 
}

.new-price {
    font-size: 18px;
    font-weight: bold;
    color: red; 
}


    .original-price {
        text-decoration: line-through; /* Gạch ngang cho giá gốc */
        color: #888; /* Màu sắc cho giá gốc */
        margin-right: 10px; /* Khoảng cách giữa giá gốc và giá sale */
    }

    .sale-price {
        color: red; /* Màu sắc cho giá sale */
    }

    /* CSS cho ảnh trong carousel */
    .carousel-inner img {
        width: 100%;
        height: 600px; /* Chiều cao cố định */
        object-fit: cover; /* Đảm bảo ảnh không bị méo */
    }

    /* Định dạng cho sản phẩm */
    .product-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%; /* Để các sản phẩm đều có chiều cao giống nhau */
    }

    .section-btn-25 a.btn {
        transition: all 0.3s ease-in-out;
    }

    .section-btn-25 a.btn:hover {
        background-color: #ff6f61; /* Màu mới khi hover */
        color: white;
        transform: translateY(-5px); /* Di chuyển lên nhẹ khi hover */
    }




    .product-wish.wish.active {
        color: red; /* Đổi màu khi sản phẩm được yêu thích */
    }
    .promotion-section h2 {
        color: #FF6600;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .promotion-section p {
        color: #00CC00;
        font-size: 18px;
        margin-bottom: 30px;
    }

    .promotion-section .btn {
        padding: 15px 30px;
        font-size: 16px;
    }


    


    .special-offer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    padding: 50px;
    margin-bottom: 50px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Tạo hiệu ứng đổ bóng */
    border: 2px solid #ddd; /* Viền bên ngoài */
    
}

.offer-text {
    flex: 1;
    padding-right: 20px;
}

.offer-text h2 {
    color: #ff6600;
    font-size: 32px;
    font-weight: bold;
}

.offer-text p {
    font-size: 18px;
    color: #555;
}

.offer-text .btn {
    padding: 15px 30px;
    font-size: 16px;
}

.offer-image {
    flex: 1;
    text-align: right;
}

.offer-image img {
    max-width: 100%;
    height: auto;
    border-radius: 10px; /* Bo tròn ảnh */
}
.product-wrapper {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    margin-bottom: 20px;
}
.product-wrapper:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
}
.product-media {
    position: relative;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-media img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
}

.product-label {
    position: absolute;
    top: 10px;
    left: 10px;
    background: red;
    padding: 5px 10px;
    color: white;
    font-weight: bold;
    border-radius: 5px;
}

.product-wish {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.8);
    padding: 5px;
    border-radius: 50%;
    cursor: pointer;
}

.product-content {
    padding: 15px;
    text-align: center;
}

.product-name a {
    color: #333;
    font-size: 16px;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-name a:hover {
    color: #007bff;
}

.product-price {
    margin-top: 10px;
    font-size: 16px;
}

.old-price {
    color: #999;
}

.new-price {
    font-size: 18px;
    font-weight: bold;
}
.row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: space-between;
}
.col-lg-3, .col-md-4, .col-sm-6 {
    flex: 0 0 23%;
    max-width: 23%; 
}
@media (max-width: 992px) {
    .col-lg-3, .col-md-4 {
        flex: 0 0 33.33%;
        max-width: 33.33%; 
    }
}

@media (max-width: 768px) {
    .col-lg-3, .col-md-4, .col-sm-6 {
        flex: auto;
        max-width: 10%; 
        margin-bottom: 15px;
    }
}
@media (max-width: 576px) {
    .col-lg-3, .col-md-4, .col-sm-6 {
        flex: 0 0 100%;
        max-width: 100%; 
    }
}
.product-wish {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 5px;
    cursor: pointer; 
    background: none; 
}
.d-flex.align-items-center {
    display: flex;
    justify-content: center; 
    gap: 10px; 
    margin: 0; 
}

.d-flex.align-items-center form button, 
.d-flex.align-items-center a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border: none;
    margin: 0; 
    padding: 0; 
    transition: background-color 0.3s ease;
}

.d-flex.align-items-center form button:hover,
.d-flex.align-items-center a:hover {
    background-color: #0056b3; 
}





/* category */
.product-names {
    word-wrap: break-word; /* Để cho phép xuống dòng */
    overflow-wrap: break-word; /* Đảm bảo từ dài cũng sẽ xuống dòng */
    white-space: normal; /* Để cho phép dòng mới khi cần thiết */
}
.product-content {
    max-width: 250px; /* Hoặc chiều rộng bạn mong muốn */
}
.product-item {
    border: 1px solid #ccc; /* Khung bao quanh sản phẩm */
    border-radius: 5px; /* Bo tròn góc */
    padding: 10px; /* Khoảng cách bên trong */
    margin: 10px; /* Khoảng cách bên ngoài */
    width: calc(25% - 20px); /* Chiều rộng để vừa 4 ô trên một hàng */
    box-sizing: border-box; /* Bao gồm padding và border trong chiều rộng */
    text-align: center; /* Canh giữa nội dung */
}

.product-list {
    display: flex;
    flex-wrap: wrap; /* Cho phép ô sản phẩm xuống dòng nếu không đủ chỗ */
    justify-content: space-between; /* Tạo khoảng cách đều giữa các ô sản phẩm */
}

.product-item:hover {
    transform: scale(1.05); /* Phóng to ô sản phẩm khi hover */
}

.product-item img {
    max-width: 100%; /* Đảm bảo hình ảnh không vượt quá chiều rộng ô */
    height: auto; /* Giữ tỷ lệ của hình ảnh */
    border-radius: 4px; /* Bo góc cho hình ảnh */
}

.product-item h3 {
    font-size: 18px; /* Kích thước chữ cho tên sản phẩm */
    margin: 10px 0; /* Khoảng cách trên và dưới cho tên sản phẩm */
}

.product-item p {
    font-size: 16px; /* Kích thước chữ cho giá sản phẩm */
    color: #333; /* Màu chữ cho giá sản phẩm */
}





.promotion-section {
    position: relative;
    background: url('{{ asset('img/banner7.jpg') }}') no-repeat center center;
    background-size: cover;
    padding: 60px;
    text-align: center;
    color: white;
    margin-bottom: 50px;
}

.promotion-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Điều chỉnh độ mờ */
    z-index: 2; /* Đảm bảo lớp mờ ở dưới nội dung */
}

.promotion-section h2,
.promotion-section p {
    position: relative; /* Đưa nội dung lên trên lớp mờ */
    z-index: 2;
}
.out-of-stock {
    opacity: 0.5; /* Làm mờ sản phẩm */
    pointer-events: none; /* Tắt các sự kiện chuột, không cho nhấn vào sản phẩm */
}

.product-label.out-of-stock {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: red;
    color: white;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
}
</style>
@endsection
