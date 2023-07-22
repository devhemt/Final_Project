@extends('layout.default')
@section('content')

    <main id="main">

        <!--=========================-->
        <!--=        Slider         =-->
        <!--=========================-->


        <section class="slider-wrapper">
          @livewire('client.banner.banner2')
        </section>
        <!-- Slides end -->



      <!--=========================-->
      <!--=        Banner         =-->
      <!--=========================-->

      @livewire('client.banner.banner1')
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
        @livewire('client.banner.banner3')

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
                  <p>Let us show you the lastest! Sign up for emails to get the scoop on new arrrivals, free delivery, promotions and more.</p>
                  <div class="popup-subscribe">
                      <div class="subscribe-wrapper">
                          <input placeholder="Enter Keyword" type="text">
                          <button type="submit">SUBSCRIBE</button>
                      </div>
                  </div>

                  <input type="checkbox" name="vehicle" value="Bike">
                  <span >Don't show this popup again</span>

              </div>
          </div>
      </div>
        @endif
{{--      <-- Quick View -->--}}
        @livewire('client.quickview.quickview')



    </main>
@endsection
