<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                    <h6 class="mb-0 text-muted">{{$totalquantity}} items</h6>
                                </div>
                                <hr class="my-4">
                                @if($flag == 0)
                                    @foreach($customer_cart as $c)
                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img
                                                    src="{{url('images/'.$c->demo_image)}}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <h6 class="text-muted">{{$c->name}}</h6>
                                                <h6 class="color">Color:
                                                    <div class="color-container">
                                                        <div id="colors" class="colors" style="background-color:{{$c->color}};"></div>
                                                    </div>
                                                </h6>
                                                <h6 class="size">Size:
                                                    <div class="size-container">
                                                        <div id="sizes" class="sizes">{{$c->size}}</div>
                                                    </div>
                                                </h6>
                                                <h6 class="text-danger">
                                                    @if(isset($checked[$c->property_id]))
                                                        {{$checked[$c->property_id]}}
                                                    @endif
                                                </h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <button wire:click="minus({{$c->property_id}})" class="btn btn-link px-2">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <input id="form3" class="quantity" min="0" name="quantity" value="{{$c->amount}}" type="number" readonly/>

                                                <button wire:click="plus({{$c->property_id}})" class="btn btn-link px-2">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0">$ {{ number_format($c->price, 2) }}</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <a href="#!" class="text-muted"><i wire:click="deleteCartItem({{$c->property_id}})" class="fas fa-times"></i></a>
                                            </div>
                                        </div>

                                        <hr class="my-4">
                                    @endforeach
                                @endif
                                @if($flag == 1)
                                @foreach($guest_cart as $c)
                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img
                                            src="{{url('images/'.$c['attributes']['image'])}}"
                                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h6 class="text-muted">{{$c['name']}}</h6>
                                        <h6 class="color">Color:
                                            <div class="color-container">
                                                <div id="colors" class="colors" style="background-color:{{$c['attributes']['color']}};"></div>
                                            </div>
                                        </h6>
                                        <h6 class="size">Size:
                                            <div class="size-container">
                                                <div id="sizes" class="sizes">{{$c['attributes']['size']}}</div>
                                            </div>
                                        </h6>
                                            <h6 class="text-danger">
                                                @if(isset($checked[$c['id']]))
                                                {{$checked[$c['id']]}}
                                                @endif
                                            </h6>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button wire:click="minus({{$c['id']}})" class="btn btn-link px-2">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form3" class="quantity" min="0" name="quantity" value="{{$c['quantity']}}" type="number" readonly/>

                                        <button wire:click="plus({{$c['id']}})" class="btn btn-link px-2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h6 class="mb-0">$ {{ number_format($c['price'], 2) }}</h6>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="#!" class="text-muted"><i wire:click="deleteCartItem({{$c['id']}})" class="fas fa-times"></i></a>
                                    </div>
                                </div>

                                <hr class="my-4">
                                @endforeach
                                @endif

                                <div class="pt-5">
                                    <h6 class="mb-0"><a href="{{url('shop/all')}}" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-capitalize" style="color: #b55012">Sub-total</h5>
                                    <h5>${{ number_format($total, 2) }}</h5>
                                </div>

                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-capitalize" style="color: #B55012FF">Discount</h5>
                                    <h5>$ {{ number_format($discount, 2) }}</h5>
                                </div>

                                <hr class="my-4">
                                <h5 class="text-uppercase mb-3">Shipping</h5>

                                <div class="mb-4 pb-2">
                                    <select wire:model="deliverymethod" style="width: 100%; padding: 10px; border: 1px solid #533f03; border-radius: 5px; background-color: #FFFFFF; color:  #533f03;">
                                        @foreach ($options as $op)
                                            @if ($op=='Default delivery $5')
                                                <option selected="selected" value="{{ $op }}" style="background-color: #FFFFFF; color: #533f03; border: 1px solid #c7a78b; text-align: center;">{{ $op }}</option>
                                            @else
                                                <option value="{{ $op }}" style="background-color: #fff; color: #533f03; border: 1px solid #c7a78b; text-align: center;">{{ $op }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">Total price</h5>
                                    <h5>$ {{ number_format($totalpl, 2) }}</h5>
                                </div>
                                @if($momodirec)
                                    <form method="POST" action="{{ url('create/invoice') }}">
                                        @csrf
                                        <div class="d-flex justify-content-between mb-5">
                                            <input hidden name="delivery" value="{{$deliverymethod}}">
                                            <input hidden name="amount" value="{{$totalpl}}">
{{--                                            <input type="submit" class="btn btn-info" value="MoMo payment">--}}
                                            <input type="submit"  class="btn btn-dark btn-block btn-lg" id="visitor-btn" value="MoMo payment" style="background-color: #33CC99">
                                        </div>
                                    </form>
                                    <button wire:click="register" type="button" class="btn btn-dark btn-block btn-lg"
                                            data-mdb-ripple-color="dark" id="visitor-btn">Cash payment</button>
                                @endif
                                @if(!$momodirec)
                                    <form>
                                        <div class="d-flex justify-content-between mb-5">
                                            <input onclick="openForm()" type="button" class="btn btn-info" value="MoMo payment">
                                        </div>
                                    </form>
                                    <button onclick="openForm()" type="button" class="btn btn-dark btn-block btn-lg"
                                            data-mdb-ripple-color="dark" id="visitor-btn">Cash payment</button>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
