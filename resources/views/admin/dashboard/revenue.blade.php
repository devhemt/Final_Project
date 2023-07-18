@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">Revenue</li>
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
                                <a href="{{url('admin/db/revenue/1')}}" class="vuong @if($time == 1) active @endif" style="width: 50px;">
                                    today
                                </a>
                                <a href="{{url('admin/db/revenue/2')}}" class="vuong @if($time == 2) active @endif" style="width: 80px;">
                                    this month
                                </a>
                                <a href="{{url('admin/db/revenue/3')}}" class="vuong @if($time == 3) active @endif" style="width: 80px;">
                                    this year
                                </a>
                            </div>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Link</th>
                                    <th>Payment</th>
                                    <th>Pay</th>
                                    <th>True Pay</th>
                                    <th>Revenue</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        @if($order->status != 8)
                                        <td><a href="{{url('admin/order/'.$order->id)}}" class="text-primary fw-bold">Xem chi tiết</a></td>
                                        @endif
                                        @if($order->status == 8)
                                                <td><a href="{{url('admin/offline/add/'.$order->id)}}" class="text-primary fw-bold">Xem chi tiết</a></td>
                                        @endif
                                        <td>{{$order->payment}}</td>
                                        <td>{{$order->pay}}</td>
                                        <td>{{$order->true_pay}}</td>
                                        <td>{{$order->pay-$order->true_pay}}</td>
                                    </tr>
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
