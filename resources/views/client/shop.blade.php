@extends('layout.default')
@section('content')
    <main id="main">
		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="{{url('/')}}">Home  |</a> SHOP {{$category}}</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!--=========================-->
		<!--=        Shop area          =-->
		<!--=========================-->

		<section class="shop-area">
			<div class="container-fluid custom-container">
                @livewire('client.shop.shop',['category' => $category])
			</div>
		</section>

        <!--=========================-->
        <!--=   Product Quick view area    =-->
        <!--=========================-->

        <!-- Quick View -->
        @livewire('client.quickview.quickview')
    </main>
@endsection
