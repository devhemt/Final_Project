<section class="account-area">
    <div class="container-fluid custom-container">

        <div wire:ignore id="myModal1" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <div class="icon-box d-flex justify-content-center align-items-center" style="color: #f15e5e;">
                            <i class="material-icons" >&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title text-center" style="margin-right: 24px;">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Do you really want to cancel this order? <br> This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button wire:click="yes" type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <div class="account-details">
                    <p>Account</p>
                    <ul>
                        <li>{{$customer->name}}</li>
                        <li>{{$customer->email}}</li>
                        <li>{{$customer->phone}}</li>
                    </ul>
                </div>
                <a href="{{ route('signout') }}" class="btn-two">Sign Out</a>

            </div>
            @livewire('client.account.address')
            <div class="col-xl-12">
                <div class="account-table">
                    <h6>Ordered order</h6>
                    <table class="tables">
                        <thead>
                        <tr>
                            <th>Order</th>
                            <th>Created Date</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order1 as $p)
                        <tr>
                            <td>
                                <a>#{{$p->id}}</a>
                            </td>
                            <td>
                                {{$p->created_at}}
                            </td>
                            <td>
                                {{$p->pay}}
                            </td>
                            <td>
                                {{$p->payment}}
                            </td>
                            <td>
                                @if($p->status == 0)
                                    canceled
                                @elseif($p->status == 1)
                                    pending
                                @elseif($p->status == 2)
                                    confirmed
                                @elseif($p->status == 3)
                                    packing
                                @elseif($p->status == 4)
                                    delivery
                                @elseif($p->status == 5)
                                    delivered
                                @elseif($p->status == 6)
                                    delivery failed
                                @elseif($p->status == 7)
                                    return
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <a href="{{url('/order/'.$p->id)}}"><i class="fas fa-eye "></i></a>
                                <a href="#myModal1" data-toggle="modal" id="deleteprd"><i wire:click="block('{{$p->id}}')" class="fas fa-trash " title="cancel order"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="account-table">
                    <h6>Orders cannot be canceled by the customer</h6>
                    <table class="tables">
                        <thead>
                        <tr>
                            <th>Order</th>
                            <th>Created Date</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order2 as $p)
                            <tr>
                                <td>
                                    <a>#{{$p->id}}</a>
                                </td>
                                <td>
                                    {{$p->created_at}}
                                </td>
                                <td>
                                    {{$p->pay}}
                                </td>
                                <td>
                                    {{$p->payment}}
                                </td>
                                <td>
                                    @if($p->status == 0)
                                        canceled
                                    @elseif($p->status == 1)
                                        pending
                                    @elseif($p->status == 2)
                                        confirmed
                                    @elseif($p->status == 3)
                                        packing
                                    @elseif($p->status == 4)
                                        delivery
                                    @elseif($p->status == 5)
                                        delivered
                                    @elseif($p->status == 6)
                                        delivery failed
                                    @elseif($p->status == 7)
                                        return
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{url('/order/'.$p->id)}}"><i class="fas fa-eye "></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.col-xl-9 -->

        </div>
    </div>
</section>
