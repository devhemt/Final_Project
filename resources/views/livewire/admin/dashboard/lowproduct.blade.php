<div class="col-12">
    <div class="card top-selling overflow-auto">
        <div class="card-body pb-0">
            <h5 class="card-title">Product Is Low In Stock <span>(<= 10) || <a href="{{url('admin/db/lowproduct/10')}}">detail</a></span></h5>

            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">Preview</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lowProducts as $product)
                    <tr>
                        <th scope="row"><a href="{{url('admin/product/'.$product->id)}}"><img src="{{asset('images/'.$product->demo_image)}}" alt=""></a></th>
                        <td>{{$product->product_code}}</td>
                        <td><a href="{{url('admin/product/'.$product->id)}}" class="text-primary fw-bold">{{$product->name}}</a></td>
                        <td>${{$product->price}}</td>
                        <td class="fw-bold">{{$product->total_amount}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
