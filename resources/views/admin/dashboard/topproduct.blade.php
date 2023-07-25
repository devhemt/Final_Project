@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">Top products</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex">
                                <p>More:</p>
                                <a href="{{url('admin/db/topproduct/1')}}" class="vuong @if($time == 1) active @endif" style="width: 50px;">
                                    today
                                </a>
                                <a href="{{url('admin/db/topproduct/2')}}" class="vuong @if($time == 2) active @endif" style="width: 80px;">
                                    this month
                                </a>
                                <a href="{{url('admin/db/topproduct/3')}}" class="vuong @if($time == 3) active @endif" style="width: 80px;">
                                    this year
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
                                    <th>Sold</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topProducts as $product)
                                    <tr>
                                        <td>{{$stt}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td><a href="{{url('admin/product/'.$product->id)}}" class="text-primary fw-bold">{{$product->name}}</a></td>
                                        <td><img src="{{asset('images/'.$product->demo_image)}}" alt=""></td>
                                        <td>{{$product->price}} $</td>
                                        <td>{{$product->total_sales}}</td>
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
