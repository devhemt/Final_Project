<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assetsAdmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsAdmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsAdmin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsAdmin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsAdmin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsAdmin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsAdmin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="{{ asset('assetsAdmin/css/styleadmin.css') }}" rel="stylesheet">

  @livewireStyles
</head>

<body>
@include('sweetalert::alert')
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
      <a href="{{url('admin')}}" class="logo d-flex align-items-center">
        <img src="{{asset('assetsAdmin/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block">KF Admin</span>
      </a>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      @livewire('admin.profile.smallnavadmin')
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{asset('admin')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
          <a class="nav-link collapsed" href="{{ url('admin/category/show') }}">
              <i class="bi bi-grid"></i>
              <span>Category</span>
          </a>
          <a class="nav-link collapsed" href="{{ url('admin/supplier/show') }}">
              <i class="bi bi-grid"></i>
              <span>Supplier</span>
          </a>
          <a class="nav-link collapsed" href="{{ url('admin/purchase/show') }}">
              <i class="bi bi-grid"></i>
              <span>Import Purchase</span>
          </a>
          <a class="nav-link collapsed" href="{{ url('admin/product') }}">
              <i class="bi bi-grid"></i>
              <span>Product</span>
          </a>
      </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#das-ele-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Dashboard Element</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="das-ele-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('admin/lowproduct/10') }}">
                        <i class="bi bi-circle"></i><span>Low products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/topproduct/1') }}">
                        <i class="bi bi-circle"></i><span>Top products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/revenue/1') }}">
                        <i class="bi bi-circle"></i><span>Revenue</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/topcity/1') }}">
                        <i class="bi bi-circle"></i><span>Top city</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/newcustomer/1') }}">
                        <i class="bi bi-circle"></i><span>Customer</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#cus-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cus-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('admin/create/customer') }}">
                        <i class="bi bi-circle"></i><span>Create customer</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/showcustomer/1') }}">
                        <i class="bi bi-circle"></i><span>Show customer</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('admin/customer_order')}}">
                        <i class="bi bi-circle"></i><span>Customer order</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/guest_order')}}">
                        <i class="bi bi-circle"></i><span>Guest order</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Account</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('admin/profile/create')}}">
              <i class="bi bi-circle"></i><span>Create account</span>
            </a>
          </li>
            <li>
                <a href="{{url('admin/profile/showall')}}">
                    <i class="bi bi-circle"></i><span>All account</span>
                </a>
            </li>
        </ul>
      </li><!-- End Tables Nav -->




      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('admin/profile')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

    @yield('content')



      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Vendor JS Files -->
      <script src="{{ asset('assetsAdmin/vendor/apexcharts/apexcharts.min.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/chart.js/chart.min.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/echarts/echarts.min.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/quill/quill.min.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/simple-datatables/simple-datatables.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/tinymce/tinymce.min.js') }}"></script>
      <script src="{{ asset('assetsAdmin/vendor/php-email-form/validate.js') }}"></script>

      <!-- Template Main JS File -->
      <script src="{{ asset('assetsAdmin/js/mainadmin.js') }}"></script>
      @livewireScripts
    </body>

    </html>
