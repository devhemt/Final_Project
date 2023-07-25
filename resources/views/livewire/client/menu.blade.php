<ul id="navigation">
    <li><a href="{{ url('/') }}" class="active">home</a>
    </li>

    <li class="has-child"><a href="{{ url('/shop/all') }}">Categories</a>
        <ul class="sub-menu">
            @foreach($categories as $category)
            <li><a href="{{ url('/shop/'.$category->category_name) }}">{{$category->category_name}}</a></li>
            @endforeach
        </ul>
    </li>

    <li><a href="{{ url('/shop/all') }}">All products</a></li>

{{--    <li><a href="{{ url('/blog') }}">blog</a></li>--}}
    <li><a href="{{ url('/contact') }}">CONTACT</a></li>
</ul>
