@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Detail of product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            @livewire('admin.product.prd',['idprd'=>$id])
        </section>

    </main>
@endsection
