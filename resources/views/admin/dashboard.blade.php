@extends('layout.defaultadmin')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
{{--              @livewire('salescard')--}}
            <!-- End Sales Card -->
{{--              import money--}}
{{--              @livewire('importmoney')--}}
            <!-- Revenue Card -->
{{--              @livewire('revenuecard')--}}
            <!-- End Revenue Card -->

            <!-- Customers Card -->
{{--              @livewire('customerscard')--}}
            <!-- End Customers Card -->

            <!-- Reports -->
{{--              @livewire('reports')--}}
            <!-- End Reports -->

            <!-- Top Selling -->
{{--              @livewire('topselling')--}}
            <!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

{{--        <!-- Right side columns -->--}}
{{--        <div class="col-lg-4">--}}

{{--          <!-- Recent Activity -->--}}
{{--            @livewire('recentact')--}}
{{--          <!-- End Recent Activity -->--}}

{{--          <!-- Budget Report -->--}}
{{--            @livewire('budgetreport')--}}
{{--          <!-- End Budget Report -->--}}



{{--        </div><!-- End Right side columns -->--}}

      </div>
    </section>

  </main><!-- End #main -->
@endsection
