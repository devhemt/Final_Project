@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Order</li>
                    <li class="breadcrumb-item active">Noprocess order</li>
                </ol>
            </nav>
            @livewire('searchadmin',['currentURL' => $currentURL])
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        @livewire('noprocessorder')
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
