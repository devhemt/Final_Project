<section class="product-small">
    <div class="container-fluid  custom-container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="small-sec-title">
                    <h6>TOP <span>SALE</span></h6>
                </div>
                <!-- Single product-->
                @foreach ($sale as $p)
                <div class="sin-product-s">
                    <div class="sp-img">
                        <img src="{{ asset('images/'.$p->demo_image) }}" alt="">
                    </div>
                    <div class="small-pro-details">
                        <h5 class="title" ><a style="max-width: 120px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                        @if($flag[$p->id])
                        <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($price[$p->id], 2) }}</span>
                        <span class="regular-price" id="{{ $p->price }}" style="text-decoration: line-through; display: inline-block; margin-bottom: 5px;">${{ number_format($p->price, 2) }}</span>
                        @else
                            <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($p->price, 2) }}</span>
                        @endif
                        <a class="trigger" href="#{{ $p->name }}" style="display: block; " wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- col -->

            <div class="col-sm-6 col-xl-3  col-md-6">
                <div class="small-sec-title">
                    <h6>TOP <span>DAILY</span></h6>
                </div>
                @foreach ($topDay as $p)
                <!-- Single product-->
                    <div class="sin-product-s">
                        <div class="sp-img">
                            <img src="{{ asset('images/'.$p->demo_image) }}" alt="">
                        </div>
                        <div class="small-pro-details">
                            <h5 class="title" ><a style="max-width: 120px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                            @if($flag[$p->id])
                                <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($price[$p->id], 2) }}</span>
                                <span class="regular-price" id="{{ $p->price }}" style="text-decoration: line-through; display: inline-block; margin-bottom: 5px;">${{ number_format($p->price, 2) }}</span>
                            @else
                                <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($p->price, 2) }}</span>
                            @endif
                            <a class="trigger" href="#{{ $p->name }}" style="display: block; " wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- col -->

            <div class="col-sm-6 col-xl-3  col-md-6">
                <div class="small-sec-title">
                    <h6>BEST<span> MONTHLY</span></h6>
                </div>
                @foreach ($topMonth as $p)
                    <!-- Single product-->
                    <div class="sin-product-s">
                        <div class="sp-img">
                            <img src="{{ asset('images/'.$p->demo_image) }}" alt="">
                        </div>
                        <div class="small-pro-details">
                            <h5 class="title" ><a style="max-width: 120px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                            @if($flag[$p->id])
                                <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($price[$p->id], 2) }}</span>
                                <span class="regular-price" id="{{ $p->price }}" style="text-decoration: line-through; display: inline-block; margin-bottom: 5px;">${{ number_format($p->price, 2) }}</span>
                            @else
                                <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($p->price, 2) }}</span>
                            @endif
                            <a class="trigger" href="#{{ $p->name }}" style="display: block; " wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- col -->

            <div class="col-sm-6 col-xl-3 col-md-6">
                <div class="small-sec-title">
                    <h6>LASTEST <span>PRODUCTS</span></h6>
                </div>
                @foreach ($latest as $p)
                    <!-- Single product-->
                    <div class="sin-product-s">
                        <div class="sp-img">
                            <img src="{{ asset('images/'.$p->demo_image) }}" alt="">
                        </div>
                        <div class="small-pro-details">
                            <h5 class="title" ><a style="max-width: 120px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                            @if($flag[$p->id])
                                <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($price[$p->id], 2) }}</span>
                                <span class="regular-price" id="{{ $p->price }}" style="text-decoration: line-through; display: inline-block; margin-bottom: 5px;">${{ number_format($p->price, 2) }}</span>
                            @else
                                <span class="discounted-price" style="display: inline-block; color: #000; font-weight: bold; margin-left: 5px;">${{ number_format($p->price, 2) }}</span>
                            @endif
                            <a class="trigger" href="#{{ $p->name }}" style="display: block; " wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- col -->
        </div>
        <!-- row -->
    </div>
    <!-- container-fluid End-->
</section>
<!-- main-product 2 End -->
