@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">Low products</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <p>Amount <= {{$amount}}</p>
                            </div>
                            <div style="display: flex">
                                <p>More:</p>
                                <a href="{{url('admin/db/lowproduct/10')}}" class="circle @if($amount == 10) active @endif">
                                    10
                                </a>
                                <a href="{{url('admin/db/lowproduct/20')}}" class="circle @if($amount == 20) active @endif">
                                    20
                                </a>
                                <a href="{{url('admin/db/lowproduct/30')}}" class="circle @if($amount == 30) active @endif">
                                    30
                                </a>
                                <a href="{{url('admin/db/lowproduct/40')}}" class="circle @if($amount == 40) active @endif">
                                    40
                                </a>
                                <a href="{{url('admin/db/lowproduct/50')}}" class="circle @if($amount == 50) active @endif">
                                    50
                                </a>
                            </div>
                            @php
                                $stt = 1;
                            @endphp
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Product Code</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$stt}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td><a href="{{url('admin/product/'.$product->id)}}" class="text-primary fw-bold">{{$product->name}}</a></td>
                                        <td><img src="{{asset('images/'.$product->demo_image)}}" alt=""></td>
                                        <td>{{$product->price}} $</td>
                                        <td>{{$product->total_amount}}</td>
                                        <td>{{$product->created_at}}</td>
                                    </tr>
                                    @php
                                        $stt++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
