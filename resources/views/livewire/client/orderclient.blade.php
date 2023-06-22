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
                    <p>Informations</p>
                    <ul>
                        <li>Pay: ${{$invoice[0]->pay}}</li>
                        <li>Payment:{{$invoice[0]->payment}}</li>
                        <li>Delivery:{{$invoice[0]->delivery}}</li>
                        <li>Created_at:{{$invoice[0]->created_at}}</li>
                    </ul>
                </div>
            </div>
            <!-- /.col-xl-3 -->
            <div class="col-xl-9">
                <div class="account-table">
                    <h6>Ordered order</h6>
                    <table class="tables">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Demo image</th>
                            <th>Price</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prd as $p)
                            <tr>
                                <td>
                                    <a>#{{$p->itemsid}}</a>
                                </td>
                                <td>
                                    {{$p->name}}
                                </td>
                                <td>
                                    {{$p->demoimage}}
                                </td>
                                <td>
                                    {{$p->price}}
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{url('/product/'.$p->itemsid)}}"><i class="fas fa-eye "></i></a>
                                    <a href="#" id="deleteprd"><i wire:click="block('{{$p->itemsid}}')" class="fas fa-trash "></i></a>
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
