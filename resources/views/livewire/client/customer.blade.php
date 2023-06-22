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
        <div class="visitor-form-container" style="top:{{$top1}};">

            <form action="">
                <h3>Are you sure about reorder this order</h3>
                <input wire:click="yes1" type="button" value="Yes" class="btn danger">
                <input wire:click="no1" type="button" value="No" class="btn no">
                <p for="remember">Please consider your optios.</p>
            </form>

        </div>
        <div class="row">
            <div class="col-xl-3">
                <div class="account-details">
                    <p>Account</p>
                    <ul>
                        <li>John Abraham</li>
                        <li>demo@example.com</li>
                        <li>18 / d , North Hali </li>
                        <li>1652</li>
                    </ul>
                </div>
                <a href="{{ route('signout') }}" class="btn-two">Sign Out</a>

            </div>
            <!-- /.col-xl-3 -->
            <div class="col-xl-9">
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
                                <a>#{{$p->invoice_id}}</a>
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
                                <a href="{{url('/order/'.$p->invoice_id)}}"><i class="fas fa-eye "></i></a>
                                <a href="#" id="deleteprd"><i wire:click="block('{{$p->invoice_id}}')" class="fas fa-trash "></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="account-table">
                    <h6>orders being delivered</h6>
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
                                    <a>#{{$p->invoice_id}}</a>
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
                                    <a href="{{url('/order/'.$p->invoice_id)}}"><i class="fas fa-eye "></i></a>
                                    <a href="#" title="reorder"><i wire:click="block1('{{$p->invoice_id}}')" class="fas fa-undo"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="account-table">
                    <h6>Canceled orders</h6>
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
                        @foreach($order3 as $p)
                            <tr>
                                <td>
                                    <a>#{{$p->invoice_id}}</a>
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
                                    <a href="{{url('/order/'.$p->invoice_id)}}"><i class="fas fa-eye "></i></a>
                                    <a href="#" title="reorder"><i wire:click="block1('{{$p->invoice_id}}')" class="fas fa-undo"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="account-table">
                    <h6>Successful orders</h6>
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
                        @foreach($order4 as $p)
                            <tr>
                                <td>
                                    <a>#{{$p->invoice_id}}</a>
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
                                    <a href="{{url('/order/'.$p->invoice_id)}}"><i class="fas fa-eye "></i></a>
                                    <a href="#" title="reorder"><i wire:click="block1('{{$p->invoice_id}}')" class="fas fa-undo"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.cart-table -->
            </div>
            <!-- /.col-xl-9 -->

        </div>
    </div>
</section>
