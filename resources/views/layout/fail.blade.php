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
                                            <h2>Your order fail because some products in your order have exceeded the number of products left in stock !</h2>
                                            <img src="{{asset('images/fail.png')}}">
                                            <a href="{{url('cart')}}">back to cart</a>
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
