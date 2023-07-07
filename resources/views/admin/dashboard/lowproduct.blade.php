@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">Low products</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div id="detail" style="background: whitesmoke">
                <div>
                    <p>Amount <= {{$amount}}</p>
                </div>
                <div style="display: flex">
                    <p>More:</p>
                    <a href="{{url('admin/db/lowproduct/10')}}" class="circle
                        @if($amount == 10) active @endif
                    ">
                        10
                    </a>
                    <a href="{{url('admin/db/lowproduct/20')}}" class="circle
                        @if($amount == 20) active @endif
                    ">
                        20
                    </a>
                    <a href="{{url('admin/db/lowproduct/30')}}" class="circle
                        @if($amount == 30) active @endif
                    ">
                        30
                    </a>
                    <a href="{{url('admin/db/lowproduct/40')}}" class="circle
                        @if($amount == 40) active @endif
                    ">
                        40
                    </a>
                    <a href="{{url('admin/db/lowproduct/50')}}" class="circle
                        @if($amount == 50) active @endif
                    ">
                        50
                    </a>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><a href="{{url('admin/product/'.$product->id)}}" class="text-primary fw-bold">{{$product->name}}</a></td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->total_amount}}</td>
                            <td>{{$product->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        var table = $('#example').DataTable( {
                            "pageLength": 5,
                            lengthChange: false,
                            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
                        } );

                        table.buttons().container()
                            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
                    } );
                </script>
            </div>
        </section>

    </main>
@endsection
