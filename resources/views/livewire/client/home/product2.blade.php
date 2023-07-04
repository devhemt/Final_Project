<section class="main-product bg-one">
    <div class="container container-two">
        <div class="section-heading">
            <h3>Hottest <span>product</span></h3>
        </div>
        <!-- /.section-heading-->
        <div class="row" wire:ignore>
            <div class="col-xl-12 ">
                <div class="pro-tab-filter">
                    <div class="grid grid-three">
                        @if($size != 0)
                            @foreach($products as $p)
                                <div class="grid-item 1 2 3 4 col-sm-12 col-md-6">
                                    <div class="sin-product style-three">
                                        <div class="pro-img-three">
                                            <div class="img-show">
                                                <img src="{{ asset('images/'.$p->demoimage) }}" alt="">
                                            </div>
                                            <div class="img-hover">
                                                <img src="{{ asset('images/'.$p->demoimage) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="mid-wrapper">
                                            <h5 class="pro-title"><a href="{{url('product/'.$p->prd_id)}}">{{ $p->name }}</a></h5>
                                            <p>@if($p->categories == 1)
                                                    {{'Men'}}
                                                @elseif($p->categories == 2)
                                                    {{'Women'}}
                                                @elseif($p->categories == 3)
                                                    {{'Kid'}}
                                                @elseif($p->categories == 4)
                                                    {{'Accessories'}}
                                                @endif / <span>${{ $p->price }}</span></p>
                                        </div>
                                        <div class="pro-icon style-three">
                                            <ul>
{{--                                                <li><a href="#"><i class="flaticon-valentines-heart"></i></a></li>--}}
                                                <li><a href="{{url('cart')}}"><i class="flaticon-shopping-cart"></i></a></li>
                                                <li><a class="trigger" wire:click.prefetch="showQuickView({{ $p->prd_id }})"><i class="flaticon-zoom-in"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
<!-- main-product 2 End -->
