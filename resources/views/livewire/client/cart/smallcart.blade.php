<li class="top-cart" >
    <a href="javascript:void(0)" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{$amount}}</a>
    <div class="cart-drop" wire:ignore.self>
        <div style="max-height: 200px;overflow-y: overlay;">
        @if($flag == 1)
        @foreach($guest_cart as $c)
        <div class="single-cart">
            <div class="cart-img">
                <img alt="" src="{{url('images/'.$c['attributes']['image'])}}">
            </div>
            <div class="cart-title">
                <p><a href="{{url('product/'.$c['id'])}}">{{$c['name']}}</a></p>
            </div>
            <div class="cart-price">
                <p>{{$c['quantity']}} x ${{$c['price']}}</p>
            </div>
            <a href="#"><i wire:click="deleteCartItem({{$c['id']}})" class="fa fa-times"></i></a>
        </div>
        @endforeach
        @endif
            @if($flag == 0)
                @foreach($customer_cart as $c)
                    <div class="single-cart">
                        <div class="cart-img">
                            <img alt="" src="{{url('images/'.$c->demo_image)}}">
                        </div>
                        <div class="cart-title">
                            <p><a href="{{url('product/'.$c->id)}}">{{$c->name}}</a></p>
                        </div>
                        <div class="cart-price">
                            <p>{{$c->size}} x <span style="background: {{$c->color}}">...</span></p>
                        </div>
                        <div class="cart-price">
                            <p>{{$c->amount}} x ${{$c->price}}</p>
                        </div>
                        <a href="#"><i wire:click="deleteCartItem({{$c->id}})" class="fa fa-times"></i></a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="cart-bottom">
            <div class="cart-sub-total">
                <p>Sub-Total <span>${{$subtotal}}</span></p>
            </div>
            <div class="cart-sub-total">
                <p>Eco Tax (-2.00)<span>$7.00</span></p>
            </div>
            <div class="cart-sub-total">
                <p>VAT (20%) <span>$40.00</span></p>
            </div>
            <div class="cart-sub-total">
                <p>Total <span>${{$total}}</span></p>
            </div>
            <div class="cart-checkout">
                <a href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i>View Cart</a>
            </div>
            <div class="cart-share">
                <a href="#"><i class="fa fa-share"></i>Checkout</a>
            </div>
        </div>
    </div>
</li>
