@extends('layout.default')
@section('content')

<main id="main">
    <section class="h-100 h-custom cart" id="cart">
        <!-- login form container  -->

        <div class="container">
            @livewire('client.cart.takeinfor')
        </div>

            @livewire('client.cart.truecart')

      </section>


</main>

@endsection
