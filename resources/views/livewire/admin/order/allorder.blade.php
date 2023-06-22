<div class="card-body">
    <h5 class="card-title">Table with stripped rows</h5>
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label">Select:</label>
        <div class="col-sm-3">
            <select wire:model="type" class="form-select" aria-label="Default select example">
                @foreach ($options as $op)
                    @if ($op=='Have account')
                        <option selected="selected" value="{{ $op }}">{{ $op }}</option>
                    @else
                        <option value="{{ $op }}">{{ $op }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Pay</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order as $p)
            <tr>
                <th scope="row">{{$p->invoice_id}}</th>
                <td>{{$p->name}}</td>
                <td>{{$p->phone}}</td>
                <td>{{$p->pay}}</td>
                <td>
                    @if($p->status == 0)
                        canceled
                    @elseif($p->status == 1)
                        noprocess
                    @elseif($p->status == 2)
                        confirmed
                    @elseif($p->status == 3)
                        packing
                    @elseif($p->status == 4)
                        delivery
                    @elseif($p->status == 5)
                        successful
                    @endif
                </td>
                <td style="text-align: center;">
                    <a href="{{url('admin/order/'.$p->invoice_id.'/'.$type)}}"><i class="fas fa-eye "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $order->links() }}
</div>
