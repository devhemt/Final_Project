@extends('layout.default')
@section('content')

    <main id="main">

        <!--=========================-->
        <!--=        Slider         =-->
        <!--=========================-->


        <section class="slider-wrapper">
          <div class="slider-start slider-1 owl-carousel owl-theme">

              <div class="item">
                  <img src="{{asset('images/banner4.jpg')}}" alt="">
                  <div class="container-fluid custom-container slider-content">
                      <div class="row align-items-center">

                          <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
                              <div class="slider-text ">
                                  <h4 class="animated fadeIn" style="color: black;" ><span style="color: white;" >BRAND NEW</span> COLLECTION</h4>
                                  <h1 class="animated fadeIn" style="color: white;" >ELEGANT SHOP</h1>
                                  <p class="animated fadeIn">Discover Elegant, the ultimate destination for fashionable women's clothing. Our brand is dedicated to helping you elevate your style and express your individuality through thoughtfully designed and meticulously crafted pieces.</p>
                                  <a class="animated fadeIn btn-two" href="#">SHOP NOW</a>
                              </div>
                          </div>
                          <!-- Col End -->
                      </div>
                      <!-- Row End -->
                  </div>
              </div>

              <div class="item">
                  <img src="{{asset('images/banner2.png')}}" alt="">
                  <div class="container-fluid custom-container slider-content">
                      <div class="row align-items-center">

                          <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
                              <div class="slider-text ">
                                  <h4 class="animated fadeIn" ><span style="color: white;" >BRAND NEW</span> COLLECTION</h4>
                                  <h1 class="animated fadeIn" style="color: white;" >NEW ARRIVALS</h1>
                                  <p class="animated fadeIn" style="color: #dad55e;">Our team of talented designers pays meticulous attention to fabric selection, fit, and finishing touches, ensuring that each piece not only looks stunning but also feels comfortable to wear.</p>
                                  <a class="animated fadeIn btn-two" href="#">SHOP NOW</a>
                              </div>
                          </div>
                          <!-- Col End -->
                      </div>
                      <!-- Row End -->
                  </div>
              </div>

              <div class="item">
                  <img src="{{asset('images/banner3.PNG')}}" alt="">
                  <div class="container-fluid custom-container slider-content">
                      <div class="row align-items-center">
                          <div class="col-12 col-sm-8 col-md-8 offset-md-1 col-lg-6 offset-xl-2 col-xl-5 mr-auto">
                              <div class="slider-text mob-align-left">
                                  <h4 class="animated fadeIn" style="color: white;"><span style="color: black;">LATEST COLLECTION </span> 2023 </h4>
                                  <h1 class="animated fadeIn" style="color: white;">STYLE & GRACE </h1>
                                  <p class="animated fadeIn" style="color: #dad55e;">Experience the allure of Elegant and embrace your personal style with our exquisite collection of women's clothing. Explore our latest arrivals and elevate your wardrobe today.</p>
                                  <a class="animated fadeIn btn-two" href="#">SHOP NOW</a>
                              </div>
                          </div>
                          <!-- Col End -->
                      </div>
                      <!-- Row End -->
                  </div>
              </div>

          </div>
        </section>
        <!-- Slides end -->



      <!--=========================-->
      <!--=        Banner         =-->
      <!--=========================-->

      <section class="banner padding-top-120">
          <div class="container-fluid custom-container">
              <div class="row">
                  <div class="col-12 col-md-4">
                      <a href="#">
                          <div class="sin-banner align-items-center">
                              <img src="{{asset('images/menfashion.jpg')}}" alt="">
                              <div class="sin-banner-con">
                                  <div class="sin-banner-inner-wrap">
                                      <div class="banner-top">
                                          <h4>Man's</h4>
                                          <h4>Acces <span>sories</span></h4>
                                      </div>
                                      <p>Extra</p>
                                      <h3>60% Off</h3>
                                      <span>Final sale</span>
                                      <span>Items</span>
                                  </div>
                              </div>
                          </div>
                          <!-- /.sin-banner -->
                      </a>
                  </div>
                  <!-- /.col-xl-5 -->

                  <div class="col-12 col-md-4">
                      <a href="#">
                          <div class="sin-banner style-two">

                              <img src="{{asset('images/womenfashion.png')}}" alt="">

                              <div class="sin-banner-con">
                                  <div class="sin-banner-inner-wrap">
                                      <h4>Woman's Shop</h4>
                                      <h3>40% Off</h3>
                                      <span>Best of Shop Beauty</span>
                                  </div>

                              </div>


                          </div>
                          <!-- /.sin-banner -->
                      </a>
                  </div>
                  <!-- /.col-xl-4 -->

                  <div class="col-12 col-md-4">
                      <a href="#">
                          <div class="sin-banner">
                              <img src="{{asset('images/kidfashion.jpg')}}" alt="">
                              <div class="br-wrapper">
                                  <div class="sin-banner-con-right">
                                      <p>Kids shop sale</p>
                                      <span>up to 80% off</span>
                                  </div>
                              </div>
                          </div>
                          <!-- /.sin-banner -->
                      </a>
                  </div>
                  <!-- /.col-xl-3 -->
              </div>
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- banner -->

            <!--=========================-->
      <!--=        Product Filter      =-->
      <!--=========================-->
      <section class="main-product">
        <div class="container container-two">
            <div class="section-heading">
                <h3>Welcome to <span>product</span></h3>
            </div>
            <!-- /.section-heading-->
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="pro-tab-filter">
                        @livewire('client.home.product1')
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container  -->
    </section>

      <!-- main-product 1 End -->

        @livewire('client.home.product3')

        <!--=========================-->
        <!--=   Discount Countdown area   =-->
        <!--=========================-->

        <section class="add-area">
            <div class="row">
                <img class='img-fluid w-100' src="{{asset('images/banner1.png')}}" />
            </div>
        </section>

    <!--=========================-->
    <!--=   Small Product area    =-->
    <!--=========================-->

        @livewire('client.home.product2')

    <!--=========================-->
    <!--=        Feature Area      =-->
    <!--=========================-->

    <section class="feature-area">
        <div class="container-fluid custom-container">
            <div class="row">
                <!-- Single Feature -->
                <div class="col-sm-6 col-xl-3">
                    <div class="sin-feature">
                        <div class="inner-sin-feature">
                            <div class="icon">
                                <i class="flaticon-free-delivery"></i>
                            </div>
                            <div class="f-content">
                                <h6><a href="#">FREE SHIPPING</a></h6>
                                <p>Free shipping on all order</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Feature -->
                <div class="col-sm-6  col-xl-3">
                    <div class="sin-feature">
                        <div class="inner-sin-feature">
                            <div class="icon">
                                <i class="flaticon-shopping-online-support"></i>
                            </div>
                            <div class="f-content">
                                <h6><a href="#">ONLINE SUPPORT</a></h6>
                                <p>Online support 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Feature -->
                <div class="col-sm-6  col-xl-3">
                    <div class="sin-feature">
                        <div class="inner-sin-feature">
                            <div class="icon">
                                <i class="flaticon-return-of-investment"></i>
                            </div>
                            <div class="f-content">
                                <h6><a href="#">MONEY RETURN</a></h6>
                                <p>Back guarantee under 5 days</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single Feature -->
                <div class="col-sm-6  col-xl-3">
                    <div class="sin-feature">
                        <div class="inner-sin-feature">
                            <div class="icon">
                                <i class="flaticon-sign"></i>
                            </div>
                            <div class="f-content">
                                <h6><a href="#">MEMBER DISCOUNT</a></h6>
                                <p>Onevery order over $150</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.feature-area -->


      <!--=========================-->
      <!--=   Instagram area      =-->
      <!--=========================-->

      <section class="instagram-area">
          <div class="instagram-slider owl-carousel owl-theme">
              <!-- single instagram-slider -->
              <div class="sin-instagram">
                  <img src="{{asset('images/inta1.jpg')}}" alt="">
                  <div class="hover-text">
                      <a href="https://www.instagram.com/">
                          <img src="media/images/icon/ig.png" alt="">
                          <span>instagram</span>
                      </a>
                  </div>
              </div>
              <!-- single instagram-slider -->
              <div class="sin-instagram">
                  <img src="{{asset('images/inta2.jpg')}}" alt="">
                  <div class="hover-text">
                      <a href="https://www.instagram.com/">
                          <img src="media/images/icon/ig.png" alt="">
                          <span>instagram</span>
                      </a>
                  </div>
              </div>
              <!-- single instagram-slider -->
              <div class="sin-instagram">
                  <img src="{{asset('images/inta3.jpg')}}" alt="">
                  <div class="hover-text">
                      <a href="https://www.instagram.com/">
                          <img src="media/images/icon/ig.png" alt="">
                          <span>instagram</span>
                      </a>
                  </div>
              </div>
              <!-- single instagram-slider -->
              <div class="sin-instagram">
                  <img src="{{asset('images/inta1.jpg')}}" alt="">
                  <div class="hover-text">
                      <a href="https://www.instagram.com/">
                          <img src="media/images/icon/ig.png" alt="">
                          <span>instagram</span>
                      </a>
                  </div>
              </div>
              <!-- single instagram-slider -->
              <div class="sin-instagram">
                  <img src="{{asset('images/inta2.jpg')}}" alt="">
                  <div class="hover-text">
                      <a href="https://www.instagram.com/">
                          <img src="media/images/icon/ig.png" alt="">
                          <span>instagram</span>
                      </a>
                  </div>
              </div>
          </div>
          <!-- /.instagram-slider end -->
      </section>
      <!-- /.instagram-area end-->



      <!--=========================-->
      <!--=   POPUP AREA      =-->
      <!--=========================-->

        <!--=========================-->
        <!--=   Popup 1: Báo lỗi có 2 button =-->
        <!--=========================-->
{{--        <div class="text-center">--}}
{{--            <!-- Button HTML (to Trigger Modal) -->--}}
{{--            <a href="#myModal1" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a>--}}
{{--        </div>--}}

        <!-- Modal HTML -->
        <div id="myModal1" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <div class="icon-box d-flex justify-content-center align-items-center" style="color: #f15e5e;">
                            <i class="material-icons" >&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title text-center" style="margin-right: 24px;">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Do you really want to delete these records? <br> This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!--=========================-->
        <!--=   Popup 2: Thông báo thành công  =-->
        <!--=========================-->
{{--        <div class="text-center">--}}
{{--            <!-- Button HTML (to Trigger Modal) -->--}}
{{--            <a href="#myModal2" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a>--}}
{{--        </div>--}}

        <div id="myModal2" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <div class="icon-box align-items-center" style="color: green;">
                            <i class="material-icons" style="color: green;" >&#xE876;</i>
                        </div>
                        <h4 class="modal-title" style="margin-right: 40px;">Awesome!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Your booking has been confirmed. <br> Check your email for details.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!--=========================-->
        <!--=   Popup 2: Thông báo thất bại  =-->
        <!--=========================-->
{{--        <div class="text-center">--}}
{{--            <!-- Button HTML (to Trigger Modal) -->--}}
{{--            <a href="#myModal3" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a>--}}
{{--        </div>--}}

        <!-- Modal HTML -->
        <div id="myModal3" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <div class="icon-box align-items-center" style="color: red;">
                            <i class="material-icons" style="color: red;" >&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title" style="margin-right: 70px;">Sorry!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Your transaction has failed. <br> Please go back and try again.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>


        {{--      <!-- Popup -->--}}
{{--        @if($flag)--}}
{{--      <div class="modal popup-1" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">--}}
{{--          <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--              <div class="modal-body popup-banner">--}}
{{--                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                  <span aria-hidden="true">&times;</span>--}}
{{--                  </button>--}}
{{--                  <h3>Newsletter <span>Subscribe</span></h3>--}}
{{--                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>--}}
{{--                  <div class="popup-subscribe">--}}
{{--                      <div class="subscribe-wrapper">--}}
{{--                          <input placeholder="Enter Keyword" type="text">--}}
{{--                          <button type="submit">SUBSCRIBE</button>--}}
{{--                      </div>--}}
{{--                  </div>--}}

{{--                  <input type="checkbox" name="vehicle" value="Bike">--}}
{{--                  <span>Don't show this popup again</span>--}}
{{--              </div>--}}
{{--          </div>--}}
{{--      </div>--}}
{{--        @endif--}}
{{--      <-- Quick View -->--}}
        @livewire('client.quickview.quickview')



    </main><!-- End #main -->
@endsection
