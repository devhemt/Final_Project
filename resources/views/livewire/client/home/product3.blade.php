    <!--=========================-->
    <!--=   Product  area Two   =-->
    <!--=========================-->

    <section class="banner-product">
        <div class="container container-two">
            <div class="section-heading pb-30">
                <h3>NEW <span>TRENDING</span></h3>
            </div>
            <!-- section-heading-->
            <div class="grid row" >
                @foreach ($product as $p)
                    <div class=" grid-item 1 col-6 col-md-6  col-lg-4 col-xl-3">
                        <div class="sin-product style-one">
                            <div class="pro-img">
                                <img src="{{ asset('images/'.$p->demo_image) }}" alt="">
                            </div>
                            <div class="mid-wrapper">
                                <h5 class="pro-title"><a href="{{url('product/'.$p->id)}}">{{ $p->name }}</a></h5>
                                <span id="{{ $p->price }}">${{ $p->price }}</span>
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
            </div>
        </div>
        <!-- Container-two  -->
    </section>