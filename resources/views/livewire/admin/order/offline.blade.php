<div class="card-body">
{{--    <div class="visitor-form-container" style="top:;">--}}

{{--        <form action="">--}}
{{--            <h3>Are you sure about cancel this order</h3>--}}
{{--            <input wire:click="yes" type="button" value="Yes" class="btn danger">--}}
{{--            <input wire:click="no" type="button" value="No" class="btn no">--}}
{{--            <p for="remember">Please consider your optios.</p>--}}
{{--        </form>--}}

{{--    </div>--}}

    <div class="visitor-form-container" style="top:{{$oldBox}};">
        <form>
            <div id="search" style="margin-left: 11rem;">
                <div class="search-bar">
                    <input wire:model="search" type="text" placeholder="Search" title="Enter search keyword">
                    <button type="button" title="Search" ><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="search-output" style="background: #d9d9d9; height: 20rem; width: 14rem; overflow-y: scroll; display: {{$outputBox}}; margin-left: 11rem;">
                @foreach($result as $r)
                    <a style="display: block; color: black" href="#" wire:click="show('{{$r->id}}')">{{$r->name}} ({{$r->product_code}})</a>
                @endforeach
            </div>
            @if($flag)
            <div style="display: flex">
                <p>{{$infor->product_code}}</p>
                <img style="max-height: 100px;max-width: 70px;object-fit: cover;" src="{{asset('images/'.$infor->demo_image)}}" alt="">
            </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Color</label>
                    <div class="col-sm-10">
                        <input wire:model="color" type="text" class="form-control" id="inputText">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Size</label>
                    <div class="col-sm-10">
                        <select wire:model="size" class="form-control">
                            <option value="XXS">XXS</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input wire:model="amount" min="1" type="number" class="form-control" id="inputText">
                        @error('check') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif
            <div class="text-center">
                <button type="button" wire:click="cancelAdd" class="btn btn-secondary">Cancel</button>
                <button type="button" wire:click="addCart" class="btn btn-secondary">Add product</button>
            </div>
        </form>
    </div>

    <div class="visitor-form-container" style="top:{{$cusBox}};">
        <form>
            <div id="search" style="margin-left: 11rem;">
                <div class="search-bar">
                    <input wire:model="searchCus" type="text" placeholder="Search" title="Enter search keyword">
                    <button type="button" title="Search" ><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="search-output" style="background: #d9d9d9; height: 20rem; width: 14rem; overflow-y: scroll; display: {{$outputCus}}; margin-left: 11rem;">
                @foreach($resultCus as $r)
                    <a style="display: block; color: black" href="#" wire:click="addCus('{{$r->id}}')">{{$r->name}}</a>
                @endforeach
            </div>
            <div class="text-center">
                <button type="button" wire:click="cancelCus" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-4">
            <h5 class="card-title">Customer informations</h5>
            @if($invoice->customer_id != null)
            <h6>Customer name: {{$customer->name}}</h6>
            <h6>Customer phone: {{$customer->phone}}</h6>
            <h6>Customer email: {{$customer->email}}</h6>
            @endif
        </div>
        <div class="col-4">
            <h5 class="card-title">Order informations</h5>
            <h6>Status: Buy offline</h6>
            <h6>Pay: ${{$invoice->pay}}</h6>
            <h6>Payment: {{$invoice->payment}}</h6>
            <h6>Delivery: {{$invoice->delivery}}</h6>
            <h6>Created_at: {{$invoice->created_at}}</h6>
        </div>
        <div class="col-4" style="text-align: center;">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="addProduct" class="btn btn-primary">Add product</button>
                <button wire:click="addCustomer" class="btn btn-primary">Add customer</button>
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Demo image</th>
            <th scope="col">Size</th>
            <th scope="col">Color</th>
            <th scope="col">Batch</th>
            <th scope="col">Amount</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prd as $p)
            <tr>
                <th scope="row">{{$p->name}}</th>
                <td><img src="{{asset('images/'.$p->demo_image)}}" alt=""></td>
                <td>{{$p->size}}</td>
                <td style="background: {{$p->color}};"></td>
                <td>{{$p->batch}}</td>
                <td>{{$p->amount}}</td>
                <td>
                    <a href="{{url('admin/product/'.$p->id)}}"><i title="see product detail" class="fas fa-eye "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
