<!doctype html>
<html>

<head>
    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elegant - Luxurious And Seductive</title>

    <!-- Fav Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/fav-icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/fav-icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/fav-icons/favicon-16x16.png')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Dependency Styles -->
    <link rel="stylesheet" href="{{ asset('dependencies/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/fontawesome/css/fontawesome-all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/owl.carousel/css/owl.theme.default.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/flaticon/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/wow/css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/jquery-ui/css/jquery-ui.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/venobox/css/venobox.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dependencies/slick-carousel/css/slick.css') }}" type="text/css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">


    @livewireStyles

</head>

<body id="home-version-1" class="home-version-1" data-style="default">

    @include('sweetalert::alert')

    <div class="site-content">


        <!--=========================-->
        <!--=        Header         =-->
        <!--=========================-->



        <header id="header" class="header-area">
            <div class="container-fluid custom-container menu-rel-container">
                <div class="row">
                    <!-- Logo
					============================================= -->

                    <div class="col-lg-6 col-xl-2">
                        <div class="logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset('images/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>

                    <!-- Main menu
					============================================= -->

                    <div class="col-lg-12 col-xl-7 order-lg-3 order-xl-2 menu-container">
                        <div class="mainmenu">
                            @livewire('menu')
                        </div>
                    </div>
                    <!--Main menu end-->
                    <div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3">
                        <div class="header-right-one">
                            <ul>
                                <li class="user-login">
                                    <a href="{{ url('/login') }}"><i class="fa fa-user" aria-hidden="true"></i></a>
                                </li>
                                @livewire('client.cart.smallcart')
                                <li class="top-search">
                                    @livewire('client.searchhome')
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--Container-Fluid-->
        </header>
        <!--Main Header end-->




        <!--=========================-->
        <!--=        Mobile Header     =-->
        <!--=========================-->



        <header class="mobile-header">
            <div class="container-fluid custom-container">
                <div class="row">

                    <!-- Mobile menu Opener
					============================================= -->
                    <div class="col-4">
                        <div class="accordion-wrapper">
                            <a href="#" class="mobile-open"><i class="flaticon-menu-1"></i></a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="logo">
                            <a href="index.html">
                                <img src="media/images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="top-cart">
                            <a href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true"></i> (2)</a>
                            <div class="cart-drop">
                                <div class="single-cart">
                                    <div class="cart-img">
                                        <img alt="" src="media/images/product/car1.jpg">
                                    </div>
                                    <div class="cart-title">
                                        <p><a href="">Aliquam Consequat</a></p>
                                    </div>
                                    <div class="cart-price">
                                        <p>1 x $500</p>
                                    </div>
                                    <a href="#"><i class="fa fa-times"></i></a>
                                </div>
                                <div class="single-cart">
                                    <div class="cart-img">
                                        <img alt="" src="media/images/product/car2.jpg">
                                    </div>
                                    <div class="cart-title">
                                        <p><a href="">Quisque In Arcuc</a></p>
                                    </div>
                                    <div class="cart-price">
                                        <p>1 x $200</p>
                                    </div>
                                    <a href="#"><i class="fa fa-times"></i></a>
                                </div>
                                <div class="cart-bottom">
                                    <div class="cart-sub-total">
                                        <p>Sub-Total <span>$700</span></p>
                                    </div>
                                    <div class="cart-sub-total">
                                        <p>Eco Tax (-2.00)<span>$7.00</span></p>
                                    </div>
                                    <div class="cart-sub-total">
                                        <p>VAT (20%) <span>$40.00</span></p>
                                    </div>
                                    <div class="cart-sub-total">
                                        <p>Total <span>$244.00</span></p>
                                    </div>
                                    <div class="cart-checkout">
                                        <a href="cart.html"><i class="fa fa-shopping-cart"></i>View Cart</a>
                                    </div>
                                    <div class="cart-share">
                                        <a href="#"><i class="fa fa-share"></i>Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row end -->
            </div>
            <!-- /.container end -->
        </header>

        <div class="accordion-wrapper">

            <!-- Mobile Menu Navigation
				============================================= -->
            <div id="mobilemenu" class="accordion">
                <ul>
                    <li class="mob-logo">
                        <a href="index.html">
                            <img src="{{asset('images/logo.png')}}" alt="">
                        </a>
                    </li>
                    <li><a href="#" class="closeme"><i class="flaticon-close"></i></a></li>
                    <li>
                        <a href="#" class="link">Home</a>
                    </li>
                    <li class="out-link"><a href="shop.html">Collections</a></li>

                    <li>
                        <a href="shop.html" class="link">Men<i class="fa fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="shop.html">Shop with sidebar</a></li>
                            <li><a href="shop-four-grid.html">Shop four grid</a></li>
                            <li><a href="shop-without-sidebar.html">Shop without sidebar</a></li>
                            <li><a href="product.html">Product details</a></li>
                            <li><a href="product-fullwidth.html">Product Fullwidth</a></li>
                            <li><a href="cart.html">Cart</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="link">Women<i class="fa fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="shop.html">Woman Dresses</a></li>
                            <li><a href="shop.html">Women & Flowers</a></li>
                            <li><a href="shop.html">Girl Hat in Sunlights</a></li>
                            <li><a href="shop.html">Men Watches</a></li>
                            <li><a href="shop.html">Clothes Fashion</a></li>
                            <li><a href="shop.html">Woman Dresses</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="link">Shop<i class="fa fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="shop.html">Shop with sidebar</a></li>
                            <li><a href="shop-four-grid.html">Shop four grid</a></li>
                            <li><a href="shop-without-sidebar.html">Shop without sidebar</a></li>
                            <li><a href="product.html">Product details</a></li>
                            <li><a href="product-fullwidth.html">Product Fullwidth</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="account.html">Order</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="link">Blog<i class="fa fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="single.html">Single post</a></li>
                            <li><a href="blog.html">Blog three grid</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="link">Pages<i class="fa fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="login.html">Account</a></li>
                            <li><a href="create-account.html">Signup</a></li>
                            <li><a href="account.html">Login</a></li>
                        </ul>
                    </li>


                </ul>
                <div class="mobile-login">
                    <a href="login.html">Log in</a> |
                    <a href="create-account.html">Create Account</a>
                </div>
                <form action="#" id="moble-search">
                    <input placeholder="Search...." type="text">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        @yield('content')


        <!--=========================-->
        <!--=   POPUP AREA      =-->
        <!--=========================-->

        @livewire('popup')

        <!--=========================-->
        <!--=   Footer area      =-->
        <!--=========================-->

        <footer class="footer-widget-area">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-widget">
                            <div class="logo">
                                <a href="#">
                                    <img src="{{asset('images/logowhite.png')}}" alt="">
                                </a>
                            </div>
                            <p>The comma brand's official online store in Europe. Sit back and be inspired by our current collections. You can easily order your favourite pieces online at home or on the go</p>
                            <div class="social">
                                <ul>
                                    <li><a href="https://www.facebook.com/elegantfashionhn/"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/Elegant_Clthing"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/elegant.fashionstore/"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-widget">
                            <h3>our shop</h3>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="{{url('shop')}}">Browse Products</a></li>
                                    <li><a href="{{url('blog')}}">Read Our Blog</a></li>
                                    <li><a href="{{url('contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-widget">
                            <h3>CATEGORIES</h3>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{url('shop')}}">Dress</a></li>
                                    <li><a href="{{url('shop')}}">Shirt</a></li>
                                    <li><a href="{{url('shop')}}">Skirt</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-xl-3 -->
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="footer-widget">
                            <h3>Payment Methods</h3>
                            <p>We support payment by bank transfer via momo, or direct payment in cash.</p>
                            <div class="payment-link">
                                <ul>
                                    <li>
                                        <a href="#"><img src="{{asset('media/momo.png')}}" alt=""></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{asset('media/cash.png')}}" alt=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- <div class="footer-widget">
					            <h3>News & Updates</h3>
					            <p>Sign up to get the latest on sales, new releases and more …</p>
					            <div class="footer-subscribe-wrapper">
						            <input placeholder="Enter Keyword" type="text">
						            <button type="submit">SUBSCRIBE</button>
					            </div>
				        </div> -->

                    </div>
                    <!-- /.col-xl-3 -->
                </div>
            </div>
            <!-- container-fluid -->
        </footer>
        <!-- footer-widget-area -->



        		<!-- Back to top
	    ============================================= -->

		<div class="backtotop">
			<i class="fa fa-angle-up backtotop_btn"></i>
		</div>





    </div>
    <!-- /#site -->

    <!-- Dependency Scripts -->
    <script src="{{ asset('dependencies/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dependencies/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dependencies/owl.carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dependencies/wow/js/wow.min.js') }}"></script>
    <script src="{{ asset('dependencies/isotope-layout/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('dependencies/imagesloaded/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('dependencies/jquery.countdown/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('dependencies/gmap3/js/gmap3.min.js') }}"></script>
    <script src="{{ asset('dependencies/venobox/js/venobox.min.js') }}"></script>
    <script src="{{ asset('dependencies/slick-carousel/js/slick.js') }}"></script>
    <script src="{{ asset('dependencies/headroom/js/headroom.js') }}"></script>
    <script src="{{ asset('dependencies/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <!--Google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsBrMPsyNtpwKXPPpG54XwJXnyobfMAIc"></script>


    <!-- Site Scripts -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @livewireScripts
</body>

</html>
