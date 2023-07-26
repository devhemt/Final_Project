@extends('layout.default')
@section('content')
    <main id="main">
        <!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="#">Home  |</a> Product Detail</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Shop area          =-->
		<!--=========================-->

		<section class="shop-area single-product">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="order-2 order-md-1 col-md-4 col-lg-3 col-xl-3">
						<div class=" shop-sidebar">
							<div class="sidebar-widget product-widget">
								<h6>BEST SELLERS</h6>
                                @foreach($topProducts as $t)
                                    <div class="wid-pro">
                                        <div class="sp-img">
                                            <img src="{{ asset('images/'.$t->demo_image) }}" alt="">
                                        </div>
                                        <div class="small-pro-details">
                                            <h5 class="title"><a style="max-width: 140px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{url('product/'.$t->id)}}">{{$t->name}}</a></h5>
                                            @if($flag[$t->id])
                                            <span class="discounted-price1234">${{ number_format($price[$t->id], 2) }}</span>
                                            <span class="regular-price1234">${{ number_format($t->price, 2) }}</span>
                                            @else
                                                <span class="discounted-price1234">${{ $t->price }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
							</div>

							<div class="sidebar-widget banner-wid">
								<div class="img">
									<img src="{{asset('images/inta3.jpg')}}" alt="">
								</div>
							</div>
						</div>
					</div>
					<!-- /.col-xl-3 -->
					<div class="order-1 order-md-2 col-md-8 col-lg-9 col-xl-9">
						<div class="row">
							<div class="col-lg-6 col-xl-6">
								<!-- Product View Slider -->
								<div class="quickview-slider">
                                @if(isset($images))
									<div class="slider-for">
                                        @foreach($images as $i)
										<div class="">
											<img src="{{asset('images/'.$i->url)}}" alt="Thumb">
										</div>
                                        @endforeach
									</div>

									<div class="slider-nav">
                                        @foreach($images as $i)
                                            <div class="">
                                                <img src="{{asset('images/'.$i->url)}}" alt="Thumb">
                                            </div>
                                        @endforeach
									</div>
								</div>
                                @endif
								<!-- /.quickview-slider -->
							</div>
							<!-- /.col-xl-6 -->

							@livewire('client.product.product',['prd_id' => $id])
							<!-- /.col-xl-6 -->


							<div class="col-xl-12">
								<div class="product-des-tab">
									<ul class="nav nav-tabs " role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">DESCRIPTION</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ADDITIONAL INFORMATION</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">REVIEWS</a>
										</li>
									</ul>
									<div class="tab-content" id="myTabContent">
                                    @if(isset($product))
                                    @foreach($product as $p)
										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
											<div class="prod-bottom-tab-sin description">
												<h5>Description</h5>
												<p>{!!$p->description!!}</p>

											</div>
										</div>
										<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div class="prod-bottom-tab-sin">
												<h5>Additional information</h5>
												<div class="info-wrap">
													<div class="sin-aditional-info">
														<div class="first">
															Manufacturer
														</div>
														<div class="secound">
															ThemeCity
														</div>
													</div>
                                                    <div class="sin-aditional-info">
                                                        <div class="first">
                                                            Sizes
                                                        </div>
                                                        <div class="secound">
                                                            {{$p->sizes}}
                                                        </div>
                                                    </div>
													<div class="sin-aditional-info">
														<div class="first">
															Colors
														</div>
														<div class="secound">
                                                            {{$p->colors}}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            @livewire('client.product.comment',['prd_id' => $id])
										</div>
									@endforeach
                                    @endif
                                    </div>
								</div>
							</div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.col-xl-9 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.shop-area -->

        @livewire('client.home.product4')

{{--		<section class="main-product padding-120">--}}
{{--			<div class="container container-two">--}}
{{--				<div class="section-heading">--}}
{{--					<h3>related <span>product</span></h3>--}}
{{--				</div>--}}
{{--				<!-- /.section-heading-->--}}
{{--				<div class="row inner-wrapper">--}}
{{--					<!-- Single product -->--}}
{{--					<div class="col-sm-6 col-lg-3 col-xl-3">--}}
{{--						<div class="sin-product">--}}
{{--							<div class="pro-img">--}}
{{--								<img src="{{asset('media/images/product/4.jpg')}}" alt="">--}}
{{--							</div>--}}
{{--							<div class="mid-wrapper">--}}
{{--								<h5 class="pro-title"><a href="product.html">Bandage Dresses</a></h5>--}}
{{--								<span>$60.00</span>--}}
{{--							</div>--}}
{{--							<div class="pro-icon">--}}
{{--								<ul>--}}
{{--									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>--}}
{{--									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>--}}
{{--									<li><a href="#" class="trigger"><i class="flaticon-zoom-in"></i></a></li>--}}
{{--								</ul>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<!-- Single product -->--}}
{{--					<div class="col-sm-6 col-lg-3 col-xl-3">--}}
{{--						<div class="sin-product">--}}
{{--							<div class="pro-img">--}}
{{--								<img src="{{asset('media/images/product/7.jpg')}}" alt="">--}}
{{--							</div>--}}
{{--							<div class="mid-wrapper">--}}
{{--								<h5 class="pro-title"><a href="product.html">High-Low Dresses</a></h5>--}}
{{--								<span>$110.00</span>--}}
{{--							</div>--}}
{{--							<div class="pro-icon">--}}
{{--								<ul>--}}
{{--									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>--}}
{{--									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>--}}
{{--									<li><a href="#" class="trigger"><i class="flaticon-zoom-in"></i></a></li>--}}
{{--								</ul>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<!-- Single product -->--}}
{{--					<div class="col-sm-6 col-lg-3 col-xl-3">--}}
{{--						<div class="sin-product">--}}
{{--							<div class="pro-img">--}}
{{--								<img src="{{asset('media/images/product/4.jpg')}}" alt="">--}}
{{--							</div>--}}
{{--							<div class="mid-wrapper">--}}
{{--								<h5 class="pro-title"><a href="product.html">Empire Waist Dresses</a></h5>--}}
{{--								<span>$60.00</span>--}}
{{--							</div>--}}
{{--							<div class="pro-icon">--}}
{{--								<ul>--}}
{{--									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>--}}
{{--									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>--}}
{{--									<li><a href="#" class="trigger"><i class="flaticon-zoom-in"></i></a></li>--}}
{{--								</ul>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}

{{--					<!-- Single product -->--}}
{{--					<div class="col-sm-6 col-lg-3 col-xl-3">--}}
{{--						<div class="sin-product">--}}
{{--							<div class="pro-img">--}}
{{--								<img src="{{asset('media/images/product/3.jpg')}}" alt="">--}}
{{--							</div>--}}
{{--							<div class="mid-wrapper">--}}
{{--								<h5 class="pro-title"><a href="product.html">Bodycon Dresses</a></h5>--}}
{{--								<span>$60.00</span>--}}
{{--							</div>--}}
{{--							<div class="pro-icon">--}}
{{--								<ul>--}}
{{--									<li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>--}}
{{--									<li><a href="#"><i class="flaticon-shopping-cart"></i></a></li>--}}
{{--									<li><a href="#" class="trigger"><i class="flaticon-zoom-in"></i></a></li>--}}
{{--								</ul>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<!-- Row End -->--}}
{{--			</div>--}}
{{--			<!-- Container  -->--}}
{{--		</section>--}}
{{--		<!-- main-product -->--}}

    </main>
@endsection
