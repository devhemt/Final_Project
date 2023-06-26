<div class="card-body">
    <h5 class="card-title">Table of order</h5>
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label">Select:</label>
        <div class="col-sm-3">
            <select wire:model="type" class="form-select" aria-label="Default select example">
                @for($i = 0; $i < 9; $i++)
                    <option value="{{ $i }}">{{ $options[$i] }}</option>
                @endfor
            </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Pay</th>
            <th scope="col">Created at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order as $p)
            <tr>
                <th scope="row">{{$p->id}}</th>
                <td>{{$p->name}}</td>
                <td>{{$p->phone}}</td>
                <td>{{$p->email}}</td>
                <td>{{$p->pay}} $</td>
                <td>{{$p->created_at}}</td>
                <td style="text-align: center;">
                    <a href="{{url('admin/order/'.$p->id)}}"><i class="fas fa-eye "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $order->links() }}
</div>
