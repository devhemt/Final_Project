<section class="banner padding-top-120">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-12 col-md-4">
                @if($banner1->url == null)
                <a href="{{url('shop/all')}}">
                @else
                        <a href="{{url($banner1->url)}}">
                @endif
                    <div class="sin-banner align-items-center">
                        @if($banner1->image == null)
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
                        @else
                            <img src="{{asset('images/'.$banner1->image)}}" alt="">
                        @endif
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
                <a href="{{url('shop/all')}}">
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
