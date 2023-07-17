<section class="add-area">
    @if($banner->url == null)
        <a href="{{url('shop/all')}}">
    @else
        <a href="{{url($banner->url)}}">
    @endif
        @if($banner->image == null)
        <img class='img-fluid w-100' src="{{asset('images/banner1.png')}}" />
        @else
                <img class='img-fluid w-100' src="{{asset('images/'.$banner->image)}}" />
        @endif
    </a>
</section>
