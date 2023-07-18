<div class="row">
    <div class="order-2 order-lg-1 col-lg-3 col-xl-3">
        <div class=" shop-sidebar">
            <div class="sidebar-widget range-widget">
                <h6>SEARCH BY PRICE</h6>
                <div class="sort-by-price">
                    <select wire:model="price" class="orderby" name="orderby">
                        @foreach ($options1 as $op)
                            @if ($op=='all')
                                <option selected="selected" value="{{ $op }}">{{ $op }}</option>
                            @else
                                <option value="{{ $op }}">{{ $op }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="sidebar-widget product-widget">
                <h6>BEST SELLERS</h6>
                @foreach($topProducts as $t)
                <div class="wid-pro">
                    <div class="sp-img">
                        <img src="{{ asset('images/'.$t->demo_image) }}" alt="">
                    </div>
                    <div class="small-pro-details">
                        <h5 class="title"><a href="{{url('product/'.$t->id)}}">{{$t->name}}</a></h5>
                        <span>${{$t->price}}</span>
                        <span class="pre-price">$80</span>
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
    <div class="order-1 order-lg-2 col-lg-9 col-xl-9">
        <div class="shop-sorting-area row">
            <div class="col-4 col-sm-4 col-md-6" wire:ignore>
                <ul class="nav nav-tabs shop-btn" id="myTab" role="tablist">
                    <li class="nav-item ">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="flaticon-menu"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="flaticon-list"></i></a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-sm-8 col-md-6">
                <div class="sort-by">
                    <span>Sort by :</span>
                    <select wire:model="sort" class="orderby" name="orderby">
                        @foreach ($options2 as $op)
                            @if ($op=='default sort')
                                <option selected="selected" value="{{ $op }}">{{ $op }}</option>
                            @else
                                <option value="{{ $op }}">{{ $op }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="shop-content shop-four-grid" wire:ignore.self>
            <div class="tab-content" id="myTabContent" wire:ignore.self>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>
                    <div class="row">
                    @foreach($products as $product)
                    <div class="col-sm-6 col-xl-3">
                        <div class="sin-product style-two">
                            <div class="pro-img">
                                <img src="{{ asset('images/'.$product->demo_image) }}" alt="">
                            </div>
                            @if ($product->created_at=='true')
                                <span class="new-tag">NEW!</span>
                            @endif
                            @php
                                $colorsArray = explode(' ', trim($product->colors));
                            @endphp
                            <div class="mid-wrapper">
                                <h5 class="pro-title"><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></h5>
                                <div class="color-variation">
                                    <ul>
                                        @foreach($colorsArray as $color)
                                            <li><i style="color: {{$color}}" class="fas fa-circle"></i></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p>Price:
{{--                                    <span class="discounted-price discounted-price1234" style="color: #000; font-weight: bold; margin-left: 5px;">$50</span>--}}
{{--                                    <span class="regular-price regular-price1234" id="{{ $product->price }}">${{ $product->price }}</span>--}}
                                    @php
                                        $regularPrice = $product->price * 1.1;
                                    @endphp
                                    <span class="discounted-price discounted-price1234" style="color: #000; font-weight: bold; margin-left: 5px;">${{ $product->price }}</span>
                                    <span class="regular-price regular-price1234">${{ number_format($regularPrice, 2) }}</span>
                                </p>
                            </div>
                            <div class="icon-wrapper">
                                <div class="add-to-cart">
                                    <a class="btn-two" href="#{{ $product->name }}" wire:click.prefetch="showQuickView({{ $product->id }})">Quick view</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.sin-product -->
                    </div>
                    @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" wire:ignore.self>
                    <div>
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                @foreach($products as $product)
                                    <div class="sin-product list-pro">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-6 col-xl-4">
                                                <div class="pro-img">
                                                    <img src="{{ asset('images/'.$product->demo_image) }}" alt="">
                                                </div>
                                                @if ($product->created_at=='true')
                                                    <span class="new-tag">NEW!</span>
                                                @endif
                                                @php
                                                    $colorsArray = explode(' ', trim($product->colors));
                                                @endphp
                                            </div>
                                            <div class="col-md-7 col-lg-6 col-xl-8">
                                                <div class="list-pro-det">
                                                    <h5 class="pro-title"><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></h5>
                                                    <span>${{$product->price}}</span>
                                                    <div class="color-variation">
                                                        <ul>
                                                            @foreach($colorsArray as $color)
                                                                <li><i style="color: {{$color}}" class="fas fa-circle"></i></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <p>{!! $product->description !!}</p>
                                                    <a class="btn-two" href="#{{ $product->name }}" wire:click.prefetch="showQuickView({{ $product->id }})">Quick view</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="load-more-wrapper">
                <a href="#more" wire:click="loadMore" class="btn-two">Load More</a>
            </div>
        </div>
    </div>
</div>
