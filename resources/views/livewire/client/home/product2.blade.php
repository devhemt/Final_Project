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
                        <h5 class="title"><a href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                        <span id="{{ $p->price }}">${{ $p->price }}</span>
                        <a class="trigger" href="#{{ $p->name }}" wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
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
                            <h5 class="title"><a href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                            <span id="{{ $p->price }}">${{ $p->price }}</span>
                            <a class="trigger" href="#{{ $p->name }}" wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
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
                            <h5 class="title"><a href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                            <span id="{{ $p->price }}">${{ $p->price }}</span>
                            <a class="trigger" href="#{{ $p->name }}" wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
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
                            <h5 class="title"><a href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                            <span id="{{ $p->price }}">${{ $p->price }}</span>
                            <a class="trigger" href="#{{ $p->name }}" wire:click.prefetch="showQuickView({{ $p->id }})">Buy Now</a>
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
