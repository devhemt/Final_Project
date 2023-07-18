<div class="slider-start slider-1 owl-carousel owl-theme">

    <div class="item">
        @if($banner1->image == null)
        <img src="{{asset('images/banner4.jpg')}}" alt="">
        @else
            <img src="{{asset('images/'.$banner1->image)}}" alt="">
        @endif
        <div class="container-fluid custom-container slider-content">
            <div class="row align-items-center">
                <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
                    <div class="slider-text ">
                        <h4 class="animated fadeIn" style="color: black;" ><span style="color: white;" >BRAND NEW</span> COLLECTION</h4>
                        <h1 class="animated fadeIn" style="color: white;" >ELEGANT SHOP</h1>
                        <p class="animated fadeIn">Discover Elegant, the ultimate destination for fashionable women's clothing. Our brand is dedicated to helping you elevate your style and express your individuality through thoughtfully designed and meticulously crafted pieces.</p>
                        @if($banner1->url == null)
                        <a class="animated fadeIn btn-two" href="{{url('shop/all')}}">SHOP NOW</a>
                        @else
                            <a class="animated fadeIn btn-two" href="{{url($banner1->url)}}">SHOP NOW</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item">
        @if($banner2->image == null)
        <img src="{{asset('images/banner2.png')}}" alt="">
        @else
            <img src="{{asset('images/'.$banner2->image)}}" alt="">
        @endif
        <div class="container-fluid custom-container slider-content">
            <div class="row align-items-center">
                <div class="col-12 col-sm-8 col-md-8 col-lg-6 ml-auto">
                    <div class="slider-text ">
                        <h4 class="animated fadeIn" ><span style="color: white;" >BRAND NEW</span> COLLECTION</h4>
                        <h1 class="animated fadeIn" style="color: white;" >NEW ARRIVALS</h1>
                        <p class="animated fadeIn" style="color: #dad55e;">Our team of talented designers pays meticulous attention to fabric selection, fit, and finishing touches, ensuring that each piece not only looks stunning but also feels comfortable to wear.</p>
                        @if($banner2->url == null)
                            <a class="animated fadeIn btn-two" href="{{url('shop/all')}}">SHOP NOW</a>
                        @else
                            <a class="animated fadeIn btn-two" href="{{url($banner2->url)}}">SHOP NOW</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item">
        @if($banner3->image == null)
        <img src="{{asset('images/banner3.PNG')}}" alt="">
        @else
            <img src="{{asset('images/'.$banner3->image)}}" alt="">
        @endif
        <div class="container-fluid custom-container slider-content">
            <div class="row align-items-center">
                <div class="col-12 col-sm-8 col-md-8 offset-md-1 col-lg-6 offset-xl-2 col-xl-5 mr-auto">
                    <div class="slider-text mob-align-left">
                        <h4 class="animated fadeIn" style="color: white;"><span style="color: black;">LATEST COLLECTION </span> 2023 </h4>
                        <h1 class="animated fadeIn" style="color: white;">STYLE & GRACE </h1>
                        <p class="animated fadeIn" style="color: #dad55e;">Experience the allure of Elegant and embrace your personal style with our exquisite collection of women's clothing. Explore our latest arrivals and elevate your wardrobe today.</p>
                        @if($banner3->url == null)
                            <a class="animated fadeIn btn-two" href="{{url('shop/all')}}">SHOP NOW</a>
                        @else
                            <a class="animated fadeIn btn-two" href="{{url($banner3->url)}}">SHOP NOW</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
