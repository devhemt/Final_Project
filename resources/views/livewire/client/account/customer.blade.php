<section class="account-area">
    <div class="container-fluid custom-container">
        <div class="visitor-form-container" style="top:{{$top}};">

            <form action="">
                <h3>Are you sure about cancel this order</h3>
                <input wire:click="yes" type="button" value="Yes" class="btn danger">
                <input wire:click="no" type="button" value="No" class="btn no">
                <p for="remember">Please consider your optios.</p>
            </form>

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
                                <a href="#" id="deleteprd"><i wire:click="block('{{$p->id}}')" class="fas fa-trash " title="cancel order"></i></a>
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
