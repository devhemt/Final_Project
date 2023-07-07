@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard manager</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
                    <li class="breadcrumb-item">Dashboard Element</li>
                    <li class="breadcrumb-item active">Top products</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div id="detail" style="background: whitesmoke">
                <div style="display: flex">
                    <p>More:</p>
                    <a href="{{url('admin/db/topcity/1')}}" class="vuong
                        @if($time == 1) active @endif
                    " style="width: 50px;">
                        today
                    </a>
                    <a href="{{url('admin/db/topcity/2')}}" class="vuong
                        @if($time == 2) active @endif
                    " style="width: 80px;">
                        this month
                    </a>
                    <a href="{{url('admin/db/topcity/3')}}" class="vuong
                        @if($time == 3) active @endif
                    " style="width: 80px;">
                        this year
                    </a>
                </div>
                @php
                    $stt = 1;
                @endphp
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Name</th>
                        <th>Invoice</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($citys as $city)
                        <tr>
                            <td>{{$stt}}</td>
                            <td>{{$city->province}}</td>
                            <td>{{$city->city_count}}</td>
                        </tr>
                        @php
                            $stt++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        var table = $('#example').DataTable( {
                            "pageLength": 5,
                            lengthChange: false,
                            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
                        } );

                        table.buttons().container()
                            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
                    } );
                </script>
            </div>
        </section>

    </main>
@endsection
