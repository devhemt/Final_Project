<div class="row addpd">
    <div class="col-lg-6">
        <form >
            <div class="form-group">
                <label>Product's Name</label>
                <input readonly name="prd_name" type="text" class="form-control" placeholder="{{$product[0]->name}}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input readonly name="prd_price" type="number" min="0" class="form-control" placeholder="{{$product[0]->price}}">
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <input readonly name="prd_category" type="text" class="form-control" placeholder="{{$product[0]->category_name}}">
            </div>
            <div class="form-group">
                <label>Tag</label>
                <input readonly name="prd_tag" type="text" class="form-control" placeholder="{{$product[0]->tag}}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <div style="background: white;border-radius: var(--bs-border-radius);transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">{!! $product[0]->description !!}</div>
            </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group" style="margin-top: 22px;">
            <label>Product main image</label>
            <div id="view-image">
                <img src="{{asset('images/'.$product[0]->demo_image)}}" alt="Thumb" style="height: 200px; width: 130px">
            </div>
            <br>

        </div>
        <div class="form-group">
            <label>Product's images</label>
            <div id="view-images">
                @foreach($images as $i)
                    <img src="{{asset('images/'.$i->url)}}" alt="Thumb" style="height: 200px; width: 130px">
                @endforeach
            </div>
        </div>
        </form>
    </div>
    <div style="height: 15px;
    width: 100%;
    background: #f6f9ff;"></div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Size</th>
                <th scope="col">Color</th>
                <th scope="col">Batch</th>
                <th scope="col">Amount</th>
                <th scope="col">Unit price</th>
            </tr>
            </thead>
            <tbody>
                @foreach($properties as $p)
                    <tr>
                        <td>{{$p->size}}</td>
                        <td style="background: {{$p->color}};"></td>
                        <td>{{$p->batch}}</td>
                        <td>{{$p->amount}}</td>
                        <td>{{$p->unit_price}} $</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
