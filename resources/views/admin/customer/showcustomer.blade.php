@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">new customers</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex">
                                <p>More:</p>
                                <a href="{{url('admin/showcustomer/1')}}" class="vuong
                        @if($type == 1) active @endif
                    " style="width: 120px;">
                                    Loyal customers
                                </a>
                                <a href="{{url('admin/showcustomer/2')}}" class="vuong
                        @if($type == 2) active @endif
                    " style="width: 110px;">
                                    New customer
                                </a>
                                <a href="{{url('admin/showcustomer/3')}}" class="vuong
                        @if($type == 3) active @endif
                    " style="width: 120px;">
                                    Potential customers
                                </a>
                            </div>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Invoices Count</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->invoices_count}}</td>
                                        <td>{{$address[$customer->id][2]}}, {{$address[$customer->id][1]}}, {{$address[$customer->id][0]}}</td>
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
