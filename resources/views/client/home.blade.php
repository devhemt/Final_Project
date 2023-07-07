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
                                  <a class="animated fadeIn btn-two" href="{{url('shop/all')}}">SHOP NOW</a>
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
                                  <a class="animated fadeIn btn-two" href="{{url('shop/all')}}">SHOP NOW</a>
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
                                  <a class="animated fadeIn btn-two" href="{{url('shop/all')}}">SHOP NOW</a>
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
                      <a href="{{url('shop/all')}}">
                          <div class="sin-banner align-items-center">
                              <img src="{{asset('images/banner1.1.png')}}" alt="">
                              <div class="sin-banner-con">
                                  <div class="sin-banner-inner-wrap">
                                      <div class="banner-top">
                                          <h4>Woman's</h4>
                                          <h4>Fall <span>Dress</span></h4>
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
                      <a href="{{url('shop/all')}}">
                          <div class="sin-banner style-two">

                              <img src="{{asset('images/banner1.2.jpg')}}" alt="">

                              <div class="sin-banner-con">
                                  <div class="sin-banner-inner-wrap">
                                      <h4>Woman's Clothing</h4>
                                      <h3>40% Off</h3>
                                      <span>Best of Shop Skirt</span>
                                  </div>

                              </div>


                          </div>
                          <!-- /.sin-banner -->
                      </a>
                  </div>
                  <!-- /.col-xl-4 -->

                  <div class="col-12 col-md-4">
                      <a href="{{url('shop')}}">
                          <div class="sin-banner">
                              <img src="{{asset('images/banner1.3.png')}}" alt="">
                              <div class="br-wrapper">
                                  <div class="sin-banner-con-right">
                                      <p>shirts shop sale</p>
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
                        <a class="animated fadeIn btn-two" style="background-color:#cc8500" href="{{url('/shop/all')}}">SEE MORE</a>
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
        <!--=   Banner discount    =-->
        <!--=========================-->
        <section class="add-area">
                <img class='img-fluid w-100' src="{{asset('images/banner1.png')}}" />
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




        {{--      <!-- Popup -->--}}
        @if($flag)
      <div class="modal popup-1" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-body popup-banner">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <h3>Newsletter <span>Subscribe</span></h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                  <div class="popup-subscribe">
                      <div class="subscribe-wrapper">
                          <input placeholder="Enter Keyword" type="text">
                          <button type="submit">SUBSCRIBE</button>
                      </div>
                  </div>

                  <input type="checkbox" name="vehicle" value="Bike">
                  <span>Don't show this popup again</span>
              </div>
          </div>
      </div>
        @endif
{{--      <-- Quick View -->--}}
        @livewire('client.quickview.quickview')



    </main>
@endsection
