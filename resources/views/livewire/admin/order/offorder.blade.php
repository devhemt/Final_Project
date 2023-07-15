<div class="card-body">
    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of order</h5>
        </div>
        <div class="col-6">
            <a style="float: right; margin-top: 10px;">
                <button wire:click="create" class="btn btn-primary">Add new order</button>
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Pay</th>
            <th scope="col">Created at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->pay}} $</td>
                <td>{{$p->created_at}}</td>
                <td style="text-align: center;">
                    <a href="{{url('admin/offline/add/'.$p->id)}}" title="See detai"><i class="fas fa-eye"></i></a>
                    <a href="#" wire:click="cancle('{{$p->id}}')" id="deleteprd" title="Delete order"><i class="fas fa-trash "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $order->links() }}
</div>
