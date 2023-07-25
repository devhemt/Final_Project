<section class="account-area">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-xl-3">
                <div class="account-details">
                    <p>Informations</p>
                    @foreach($invoices as $invoice)
                    <ul>
                        <li>Pay: ${{$invoice->pay}}</li>
                        <li>Payment:{{$invoice->payment}}</li>
                        <li>Delivery:{{$invoice->delivery}}</li>
                        <li>Created_at:{{$invoice->created_at}}</li>
                        <li>Customer address: {{$address[2]}}, {{$address[1]}}, {{$address[0]}}</li>
                    </ul>
                    @endforeach
                </div>
            </div>
            <!-- /.col-xl-3 -->
            <div class="col-xl-9">
                <div class="account-table">
                    <h6>Order details</h6>
                    <table class="tables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Amount</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prd as $p)
                            <tr>
                                <td>
                                    <a>{{$p->product_code}}</a>
                                </td>
                                <td>
                                    {{$p->name}}
                                </td>
                                <td>
                                    <img style="max-width: 100px;max-height: 200px;object-fit: cover;" src="{{ asset('images/'.$p->demo_image) }}" alt="">
                                </td>
                                <td>
                                    {{$p->price}}
                                </td>
                                <td>
                                    {{$p->size}}
                                </td>
                                <td style="color: {{$p->color}}">
                                    {{$p->color_name}}
                                </td>
                                <td>
                                    {{$p->amount}}
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{url('/product/'.$p->id)}}"><i class="fas fa-eye "></i></a>
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
