@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product manager</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active">Show products</li>
              </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

              <div class="col-lg-12">

                <div class="card">
                  @livewire('admin.product.showproduct')
                </div>

              </div>
            </div>
        </section>

    </main>
@endsection
