<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mironmahmud.com/greeny/assets/ltr/home-classic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 May 2024 15:06:41 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="template" content="greeny">
    <meta name="title" content="greeny - Ecommerce Food Store HTML Template">
    <meta name="keywords"
        content="organic, food, shop, ecommerce, store, html, bootstrap, template, agriculture, vegetables, products, farm, grocery, natural, online">
    <title>Classic Home - Greeny</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link href="vendor/bootstrap/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link rel="icon" href="{{ asset('/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/fontawesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/venobox/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/slickslider/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/niceselect/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home-grid.css') }}">

</head>

<body>
    <div class="backdrop"></div><a class="backtop fas fa-arrow-up" href="#"></a>
    {{-- <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <div class="header-top-welcome">
                        <p>Welcome to Ecomart in Your Dream Online Store!</p>
                    </div>
                </div>
                <div class="col-md-5 col-lg-3">
                    <div class="header-top-select">
                        <div class="header-select"><i class="icofont-world"></i><select class="select">
                                <option value="english" selected>english</option>
                                <option value="bangali">bangali</option>
                                <option value="arabic">arabic</option>
                            </select></div>
                        <div class="header-select"><i class="icofont-money"></i><select class="select">
                                <option value="english" selected>doller</option>
                                <option value="bangali">pound</option>
                                <option value="arabic">taka</option>
                            </select></div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-4">
                    <ul class="header-top-list">
                        <li><a href="offer.html">offers</a></li>
                        <li><a href="faq.html">need help</a></li>
                        <li><a href="contact.html">contact us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    <header class="header-part">
        <div class="container">
            <div class="header-content">
                <div class="header-media-group"><button class="header-user"><img src="{{ asset('img/user.png') }}"
                            alt="user"></button><a href="{{ route('index') }}"><img src={{ asset('img/logo.png') }}
                            alt="logo"></a><button class="header-src"><i class="fas fa-search"></i></button></div><a
                    href="{{ route('index') }}" class="header-logo"><img src="img/logo.png" alt="logo"></a>
                <li class="navbar-item dropdown">
                    <img src="{{ asset('/images/favicon.png') }}" alt="avatar">
                    <ul class="dropdown-position-list">
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Dashboard
                                    </a>
                                    <a href="{{ url('/profile') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                @else
                                    <li><a href="{{ route('login') }}">login</a></li>
                                    <li><a href="{{ route('register') }}">register</a></li>
                                @endauth
                            </nav>
                        @endif
                    </ul>
                </li>
                <form class="header-form"><input type="text" placeholder="Search anything..."><button><i
                    class="fas fa-search"></i></button>
                </form>
                <div class="header-widget-group">
                    <a href="compare.html" class="header-widget" title="Compare List">
                        <i class="fas fa-random"></i><sup>0</sup>
                    </a>
                    <a href="wishlist.html" class="header-widget" title="Wishlist">
                        <i class="fas fa-heart"></i><sup>0</sup>
                    </a>
                    <a href="{{ route('cart.index') }}" class="header-widget header-cart" title="Cartlist">
                        <i class="fas fa-shopping-basket"></i>
                        <sup>{{ $cartItemCount ?? 0 }}</sup> <!-- Thay $cartItemCount bằng biến chứa số lượng sản phẩm trong giỏ -->
                        <span>
                            total price<small>${{ $totalPrice ?? 0 }}</small> <!-- Thay $totalPrice bằng biến chứa tổng giá tiền -->
                        </span>
                    </a>
                </div>
        </div>
    </header>
    <nav class="navbar-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar-content">
                        <ul class="navbar-list">
                            <li class="navbar-item dropdown"><a class="navbar-link " href="{{ route('index') }}">home</a>

                            </li>
                            <li class="navbar-item dropdown-megamenu"><a class="navbar-link dropdown-arrow"
                                    href="#">shop</a>
                                <div class="megamenu">
                                    <div class="container">
                                        <div class="row">
                                            {{-- <div class="col-lg-3">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">shop pages</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="shop-5column.html">shop 5 column</a></li>
                                                        <li><a href="shop-4column.html">shop 4 column</a></li>
                                                        <li><a href="shop-3column.html">shop 3 column</a></li>
                                                        <li><a href="shop-2column.html">shop 2 column</a></li>
                                                        <li><a href="shop-1column.html">shop 1 column</a></li>
                                                    </ul>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-3">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">product pages</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="product-tab.html">product single tab</a></li>
                                                        <li><a href="product-grid.html">product single grid</a></li>
                                                        <li><a href="product-video.html">product single video</a></li>
                                                        <li><a href="product-simple.html">product single simple</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">user action</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="wishlist.html">wishlist</a></li>
                                                        <li><a href="compare.html">compare</a></li>
                                                        <li><a href="checkout.html">checkout</a></li>
                                                        <li><a href="orderlist.html">order history</a></li>
                                                        <li><a href="invoice.html">order invoice</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">other pages</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="all-category.html">all Category</a></li>
                                                        <li><a href="brand-list.html">brand list</a></li>
                                                        <li><a href="brand-single.html">brand single</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="navbar-item dropdown-megamenu"><a class="navbar-link dropdown-arrow"
                                    href="#">category</a>
                                <div class="megamenu">
                                    <div class="container megamenu-scroll">
                                        <div class="row row-cols-5">
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">vegetables</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">carrot</a></li>
                                                        <li><a href="#">broccoli</a></li>
                                                        <li><a href="#">asparagus</a></li>
                                                        <li><a href="#">cauliflower</a></li>
                                                        <li><a href="#">eggplant</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">fruits</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">Apple</a></li>
                                                        <li><a href="#">orange</a></li>
                                                        <li><a href="#">banana</a></li>
                                                        <li><a href="#">strawberrie</a></li>
                                                        <li><a href="#">watermelon</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">dairy farms</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">Butter</a></li>
                                                        <li><a href="#">Cheese</a></li>
                                                        <li><a href="#">Milk</a></li>
                                                        <li><a href="#">Eggs</a></li>
                                                        <li><a href="#">cream</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">seafoods</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">Lobster</a></li>
                                                        <li><a href="#">Octopus</a></li>
                                                        <li><a href="#">Shrimp</a></li>
                                                        <li><a href="#">Halabos</a></li>
                                                        <li><a href="#">Maeuntang</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">diet foods</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">Salmon</a></li>
                                                        <li><a href="#">Avocados</a></li>
                                                        <li><a href="#">Leafy Greens</a></li>
                                                        <li><a href="#">Boiled Potatoes</a></li>
                                                        <li><a href="#">Cottage Cheese</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">fast foods</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">burger</a></li>
                                                        <li><a href="#">milkshake</a></li>
                                                        <li><a href="#">sandwich</a></li>
                                                        <li><a href="#">doughnut</a></li>
                                                        <li><a href="#">pizza</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">drinks</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">cocktail</a></li>
                                                        <li><a href="#">hard soda</a></li>
                                                        <li><a href="#">shampain</a></li>
                                                        <li><a href="#">Wine</a></li>
                                                        <li><a href="#">barley</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">meats</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">Meatball</a></li>
                                                        <li><a href="#">Sausage</a></li>
                                                        <li><a href="#">Poultry</a></li>
                                                        <li><a href="#">chicken</a></li>
                                                        <li><a href="#">Cows</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">fishes</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">scads</a></li>
                                                        <li><a href="#">pomfret</a></li>
                                                        <li><a href="#">groupers</a></li>
                                                        <li><a href="#">anchovy</a></li>
                                                        <li><a href="#">mackerel</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="megamenu-wrap">
                                                    <h5 class="megamenu-title">dry foods</h5>
                                                    <ul class="megamenu-list">
                                                        <li><a href="#">noodles</a></li>
                                                        <li><a href="#">Powdered milk</a></li>
                                                        <li><a href="#">nut & yeast</a></li>
                                                        <li><a href="#">almonds</a></li>
                                                        <li><a href="#">pumpkin</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="navbar-item dropdown"><a class="navbar-link dropdown-arrow"
                                    href="#">pages</a>
                                <ul class="dropdown-position-list">
                                    <li><a href="faq.html">faqs</a></li>
                                    <li><a href="offer.html">offers</a></li>
                                    <li><a href="profile.html">my profile</a></li>
                                    <li><a href="wallet.html">my wallet</a></li>
                                    <li><a href="about.html">about us</a></li>
                                    <li><a href="contact.html">contact us</a></li>
                                    <li><a href="privacy.html">privacy policy</a></li>
                                    <li><a href="coming-soon.html">coming soon</a></li>
                                    <li><a href="blank-page.html">blank page</a></li>
                                    <li><a href="error.html">404 Error</a></li>
                                    <li><a href="email-template.html">email template</a></li>
                                </ul>
                            </li>
                            <li class="navbar-item dropdown"><a class="navbar-link dropdown-arrow"
                                    href="#">authentic</a>
                                <ul class="dropdown-position-list">
                                    <li><a href="{{ route('login') }}">login</a></li>
                                    <li><a href="{{ route('register') }}">register</a></li>
                                    <li><a href="reset-password.html">reset password</a></li>
                                    <li><a href="change-password.html">change password</a></li>
                                </ul>
                            </li>
                            <li class="navbar-item dropdown"><a class="navbar-link dropdown-arrow"
                                    href="#">blogs</a>
                                <ul class="dropdown-position-list">
                                    <li><a href="blog-grid.html">blog grid</a></li>
                                    <li><a href="blog-standard.html">blog standard</a></li>
                                    <li><a href="blog-details.html">blog details</a></li>
                                    <li><a href="blog-author.html">blog author</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="navbar-info-group">
                            <div class="navbar-info"><i class="icofont-ui-touch-phone"></i>
                                <p><small>call us</small><span>(+880) 183 8288 389</span></p>
                            </div>
                            <div class="navbar-info"><i class="icofont-ui-email"></i>
                                <p><small>email us</small><span>support@example.com</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @include('layouts.sidebar')
    @yield('content')


    <footer class="footer-part">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget"><a class="footer-logo" href="#"><img src="img/logo.png"
                                alt="logo"></a>
                        <p class="footer-desc">Adipisci asperiores ipsum ipsa repellat consequatur repudiandae quisquam
                            assumenda dolor perspiciatis sit ipsum dolor amet.</p>
                        <ul class="footer-social">
                            <li><a class="fab fa-facebook" href="#"></a></li>
                            <li><a class="icofont-twitter" href="#"></a></li>
                            <li><a class="icofont-linkedin" href="#"></a></li>
                            <li><a class="icofont-instagram" href="#"></a></li>
                            <li><a class="icofont-pinterest" href="#"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget contact">
                        <h3 class="footer-title">contact us</h3>
                        <ul class="footer-contact">
                            <li><i class="icofont-ui-email"></i>
                                <p><span>support@example.com</span><span>carrer@example.com</span></p>
                            </li>
                            <li><i class="icofont-ui-touch-phone"></i>
                                <p><span>+120 279 532 13</span><span>+120 279 532 14</span></p>
                            </li>
                            <li><i class="icofont-location-pin"></i>
                                <p>1Hd- 50, 010 Avenue, NY 90001 United States</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">quick Links</h3>
                        <div class="footer-links">
                            <ul>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Order History</a></li>
                                <li><a href="#">Order Tracking</a></li>
                                <li><a href="#">Best Seller</a></li>
                                <li><a href="#">New Arrivals</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">Location</a></li>
                                <li><a href="#">Affiliates</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Carrer</a></li>
                                <li><a href="#">Faq</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="footer-widget">
                        <h3 class="footer-title">Download App</h3>
                        <p class="footer-desc">Lorem ipsum dolor sit amet tenetur dignissimos ipsum eligendi autem
                            obcaecati minus ducimus totam reprehenderit exercitationem!</p>
                        <div class="footer-app"><a href="#"><img src="img/google-store.png"
                                    alt="google"></a><a href="#"><img src="img/app-store.png"
                                    alt="app"></a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom">
                        <p class="footer-copytext">&copy; All Copyrights Reserved by <a href="#">Mironcoder</a>
                        </p>
                        <div class="footer-card"><a href="#"><img src="img/01.jpg" alt="payment"></a><a
                                href="#"><img src="img/02.jpg" alt="payment"></a><a href="#"><img
                                    src="img/03.jpg" alt="payment"></a><a href="#"><img src="img/04.jpg"
                                    alt="payment"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('/vendor/bootstrap/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/vendor/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('/vendor/niceselect/nice-select.min.js') }}"></script>
    <script src="{{ asset('/vendor/slickslider/slick.min.js') }}"></script>
    <script src="{{ asset('/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('/js/nice-select.js') }}"></script>
    <script src="{{ asset('/js/countdown.js') }}"></script>
    <script src="{{ asset('/js/accordion.js') }}"></script>
    <script src="{{ asset('/js/venobox.js') }}"></script>
    <script src="{{ asset('/js/slick.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>
<!-- Mirrored from mironmahmud.com/greeny/assets/ltr/home-classic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 May 2024 15:07:59 GMT -->

</html>
