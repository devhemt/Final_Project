<ul id="navigation">
    <li><a href="{{ url('/') }}" class="@if($currentUrl == '') active @endif">home</a>
    </li>

    <li class="has-child"><a href="{{ url('/shop/all') }}" class="@if($shop) active @endif">Categories</a>
        <ul class="sub-menu">
            @foreach($categories as $category)
            <li><a href="{{ url('/shop/'.$category->category_name) }}">{{$category->category_name}}</a></li>
            @endforeach
        </ul>
    </li>

    <li><a class="@if($currentUrl == '/shop/all') active @endif" href="{{ url('/shop/all') }}">All products</a></li>

{{--    <li><a href="{{ url('/blog') }}">blog</a></li>--}}
    <li><a class="@if($currentUrl == '/contact') active @endif" href="{{ url('/contact') }}">CONTACT</a></li>
</ul>
