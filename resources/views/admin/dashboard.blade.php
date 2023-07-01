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
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
              @livewire('admin.dashboard.salescard')
            <!-- End Sales Card -->
{{--              import money--}}
              @livewire('admin.dashboard.importmoney')
            <!-- Revenue Card -->
              @livewire('admin.dashboard.revenuecard')
            <!-- End Revenue Card -->

            <!-- Customers Card -->
              @livewire('admin.dashboard.customerscard')
            <!-- End Customers Card -->

            <!-- Reports -->
              @livewire('admin.dashboard.reports')
            <!-- End Reports -->

            <!-- Top Selling -->
              @livewire('admin.dashboard.topselling')
            <!-- End Top Selling -->
              @livewire('admin.dashboard.lowproduct')

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
            @livewire('admin.dashboard.recentact')
          <!-- End Recent Activity -->

          <!-- Budget Report -->
{{--            @livewire('admin.dashboard.budgetreport')--}}
          <!-- End Budget Report -->



        </div><!-- End Right side columns -->

      </div>
    </section>
  </main>
@endsection
