@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item">Order</li>
                    <li class="breadcrumb-item active">Detail of order</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        @livewire('admin.order.prdinorder',['idinvoice'=>$id])
                    </div>

                    @livewire('admin.order.maskloadadmin')
                </div>
            </div>
        </section>

    </main>
@endsection
