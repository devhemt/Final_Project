@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">New customers</li>
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
                                <a href="{{url('admin/db/newcustomer/1')}}" class="vuong @if($time == 1) active @endif" style="width: 50px;">
                                    today
                                </a>
                                <a href="{{url('admin/db/newcustomer/2')}}" class="vuong @if($time == 2) active @endif" style="width: 80px;">
                                    this month
                                </a>
                                <a href="{{url('admin/db/newcustomer/3')}}" class="vuong @if($time == 3) active @endif" style="width: 80px;">
                                    this year
                                </a>
                            </div>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Invoices Count</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td><a href="#" class="text-primary fw-bold">{{$customer->name}}</a></td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->invoices_count}}</td>
                                        <td>{{$customer->created_at}}</td>
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
