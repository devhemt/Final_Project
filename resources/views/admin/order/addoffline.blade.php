@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Order</li>
                    <li class="breadcrumb-item active">Offline order</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @livewire('admin.order.offline',['invoice_id'=>$invoice_id])
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
