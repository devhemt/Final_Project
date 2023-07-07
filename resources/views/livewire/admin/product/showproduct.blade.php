<div class="card-body">
    <div class="visitor-form-container" style="top:{{$top}};">

        <form action="">
            <h3>Are you sure about delete this product</h3>
            <input wire:click="yes" type="button" value="Yes" class="btn danger">
            <input wire:click="no" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of products ({{$total}})</h5>
        </div>
    </div>

    @php
    $stt = 1;
    @endphp
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Name</th>
            <th scope="col">Demo image</th>
            <th scope="col">Description</th>
            <th scope="col">Total amount</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
        <tr>
            <th scope="row">{{$stt}}</th>
            <td>{{$p->name}}</td>
            <td><img src="{{asset('images/'.$p->demo_image)}}" alt=""></td>
            <td>{{$p->description}}</td>
            <td>{{$p->total_amount}}</td>
            <td>
                <a href="#" wire:click="block('{{$p->id}}')" id="deleteprd" title="Delete product"><i class="fas fa-trash "></i></a>
                <a href="{{url('admin/product/'.$p->id)}}" title="Detail of product"><i class="fas fa-eye "></i></a>
                <a href="{{url('admin/product/'.$p->id.'/edit')}}" title="Edit product"><i class="fas fa-edit "></i></a>
{{--                <a href="#" title="Add new batch"><i class="fa-solid fa-circle-plus "></i></a>--}}
            </td>
        </tr>
        @php
            $stt++;
        @endphp
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
