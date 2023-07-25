@extends('layout.default')
@section('content')

    <main id="main">
        <section class="h-100 h-custom cart" id="cart">
            <!-- login form container  -->

            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-12 bg-grey">
                                        <div class="success">
                                            <br>
                                            <img src="{{asset('images/success.png')}}">
                                            <br>
                                            <a href="{{url('shop')}}" class="btn-two">BUY MORE</a>
                                            <br>
                                            <h3><a href="{{url('login')}}">View order if you have an account</a></h3>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>


    </main>

@endsection
