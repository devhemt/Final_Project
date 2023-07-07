<ul id="navigation">
    <li><a href="{{ url('/') }}" class="active">home</a>
    </li>

    <li class="has-child"><a href="{{ url('/shop/all') }}">Categories</a>
        <ul class="sub-menu">
            @foreach($categories as $category)
            <li><a href="{{ url('/shop/'.$category->category_name) }}">{{$category->category_name}}</a></li>
            @endforeach
{{--            <li><a href="{{ url('/shop') }}">Jeans</a></li>--}}
{{--            <li><a href="{{ url('/shop') }}">Trousers</a></li>--}}
{{--            <li><a href="{{ url('/shop') }}">Jacket</a></li>--}}
{{--            <li><a href="{{ url('/shop') }}">Accessories</a></li>--}}
        </ul>
    </li>

    <li><a href="{{ url('/shop/all') }}">All products</a></li>

    {{--                                <li class="has-child"><a href="{{ url('/shop') }}">Shop</a>--}}
    {{--                                    <div class="mega-menu">--}}
    {{--                                        <div class="mega-catagory per-20">--}}
    {{--                                            <h4><a class="font-red" href="shop.html">Woman Dresses</a></h4>--}}
    {{--                                            <ul class="mega-button">--}}
    {{--                                                <li><a href="shop.html">Woman Dresses</a></li>--}}
    {{--                                                <li><a href="shop.html">Women & Flowers</a></li>--}}
    {{--                                                <li><a href="shop.html">Girl Hat in Sunlights</a></li>--}}
    {{--                                                <li><a href="shop.html">Men Watches</a></li>--}}
    {{--                                                <li><a href="shop.html">Clothes Fashion</a></li>--}}
    {{--                                            </ul>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="mega-catagory per-20">--}}
    {{--                                            <h4><a class="font-red" href="shop.html">Clothes Fashion</a></h4>--}}
    {{--                                            <ul class="mega-button">--}}
    {{--                                                <li><a href="shop.html">Woman Dresses</a></li>--}}
    {{--                                                <li><a href="shop.html">Girl Hat in Sunlights</a></li>--}}
    {{--                                                <li><a href="shop.html">Men Watches</a></li>--}}
    {{--                                                <li><a href="shop.html">Clothes Fashion</a></li>--}}
    {{--                                                <li><a href="shop.html">Woman Dresses</a></li>--}}
    {{--                                            </ul>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="mega-catagory mega-img per-30">--}}
    {{--                                            <a href="#"><img src="{{ asset("images/banerheader1.jpg") }}" alt=""></a>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="mega-catagory mega-img per-30">--}}
    {{--                                            <a href="#"><img src="{{ asset("images/banerheader2.jpg") }}" alt=""></a>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </li>--}}

    <li><a href="{{ url('/blog') }}">blog</a></li>
    <li><a href="{{ url('/contact') }}">CONTACT</a></li>
</ul>
