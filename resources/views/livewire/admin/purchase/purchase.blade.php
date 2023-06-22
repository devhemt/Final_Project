<div class="card-body">

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
                    <a href="{{url('admin/purchase/addnewproduct/'.$r->id.'/'.$purchase_id)}}">{{$r->name}}</a>
                @endforeach
            </div>
            <div class="text-center">
                <button type="button" wire:click="cancelAdd" class="btn btn-secondary">Cancel</button>
            </div>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Purchase Informations</h5>
            @foreach($thisPurchase as $p)
                <h6>Purchase code: {{$p->purchase_code}}</h6>
                <h6>Supplier: {{$p->name}}</h6>
                <h6>Total pay: {{$p->total_pay}}</h6>
                <h6>Created at: {{$p->created_at}}</h6>
            @endforeach
            <h5 class="card-title">Purchase Items</h5>
        </div>
        <div class="col-6">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="addNewProduct" class="btn btn-primary">Add new product</button>
                <button wire:click="addOldProduct" class="btn btn-primary">Add old product</button>
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->name}}</td>
                <td>{{$p->category_name}}</td>
                <td>{{$p->unit_price}} $</td>
                <td>{{$p->quantity}}</td>
                <td>
                    <a href="{{url('admin/product/'.$p->id)}}" title="Detail of product"><i class="fas fa-eye "></i></a>
                    <a href="{{url('admin/product/'.$p->id.'/edit')}}" title="Edit product"><i class="fas fa-edit "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
