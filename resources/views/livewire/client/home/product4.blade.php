<section class="main-product padding-120">
			<div class="container container-two">
				<div class="section-heading">
					<h3>best seller <span>product</span></h3>
				</div>
				<!-- /.section-heading-->
				<div class="row inner-wrapper">
					<!-- Single product -->
                    @foreach ($topMonth as $p)
                        <div class=" grid-item 1 col-6 col-md-6  col-lg-4 col-xl-3">
                            <div class="sin-product style-one">
                                <div class="pro-img">
                                    <img src="{{ asset('images/'.$p->demo_image) }}" alt="">
                                </div>
                                <div class="mid-wrapper mid-wrapper1234">
                                    <h5 class="pro-title pro-title1234"><a style="max-width: 170px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                                </div>
                                <div class="mid-wrapper mid-wrapper1234">
                                    @if($flag[$p->id])
                                        <span class="discounted-price discounted-price1234" style="color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($price[$p->id], 2) }}</span>
                                        <span class="regular-price regular-price1234">${{ number_format($p->price, 2) }}</span>
                                    @else
                                        <span class="discounted-price discounted-price1234" style="color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($p->price, 2) }}</span>
                                    @endif
                                </div>

                                <div class="pro-icon">
                                    <ul>
                                        <li><a href="{{url('cart')}}"><i class="flaticon-shopping-cart"></i></a></li>
                                        <li><a class="trigger" href="#{{ $p->name }}" wire:click.prefetch="showQuickView({{ $p->id }})"><i class="flaticon-zoom-in" ></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
				<!-- Row End -->
			</div>
			<!-- Container  -->
		</section>
		<!-- main-product -->
