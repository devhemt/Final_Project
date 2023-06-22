<div class="card-body">
    <div class="visitor-form-container" style="top:{{$top}};">

        <form action="">
            <h3>Are you sure about delete this product</h3>
            <input wire:click="yes" type="button" value="Yes" class="btn danger">
            <input wire:click="no" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>
    <div class="visitor-form-container" style="top:{{$top1}};">

        <form action="">
            <h3>Are you sure about delete this order</h3>
            <input wire:click="yes1" type="button" value="Yes" class="btn danger">
            <input wire:click="no1" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>
    <div class="row">
        <div class="col-5">
            <h5 class="card-title">Customer informations</h5>
            <h6>Customer name: {{$cusdetail[0]->name}}</h6>
            <h6>Customer phone: {{$cusdetail[0]->phone}}</h6>
            <h6>Customer email: {{$cusdetail[0]->email}}</h6>
            <h6>Customer address: {{$cusdetail[0]->address}}</h6>
        </div>
        <div class="col-5">
            <h5 class="card-title">Order informations</h5>
            <h6>Pay: ${{$invoice[0]->pay}}</h6>
            <h6>Payment: {{$invoice[0]->payment}}</h6>
            <h6>Delivery: {{$invoice[0]->delivery}}</h6>
            <h6>Created_at: {{$invoice[0]->created_at}}</h6>
        </div>
        <div class="col-2" style="text-align: center;">
            <h5 class="card-title">Order actions</h5>
            <a href="#"><i wire:click="block1" class="fas fa-trash "></i></a>
            <a href="#"><i wire:click="forward" class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Demo image</th>
            <th scope="col">Created at</th>
            <th scope="col">Update at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prd as $p)
            <tr>
                <th scope="row">{{$p->prd_id}}</th>
                <td>{{$p->name}}</td>
                <td><img src="{{asset('images/'.$p->demoimage)}}" alt=""></td>
                <td>{{$p->created_at}}</td>
                <td>{{$p->updated_at}}</td>
                <td>
                    <a href="#" wire:click="block('{{$p->prd_id}}')" id="deleteprd"><i class="fas fa-trash "></i></a>
                    <a href="{{url('admin/product/'.$p->prd_id)}}"><i class="fas fa-eye "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
