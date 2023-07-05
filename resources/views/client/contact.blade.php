@extends('layout.default')
@section('content')
    <main id="main">
    	<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->

		<section class="breadcrumb-area">
			<div class="container-fluid custom-container">
				<div class="row">
					<div class="col-xl-12">
						<div class="bc-inner">
							<p><a href="#">Home  |</a> Shop</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Breadcrumb         =-->
		<!--=========================-->



		<!--Contact area
		============================================= -->
		<section class="contact-area">
			<div class="container-fluid custom-container">
				<div class="section-heading pb-30">
					<h3>join with <span>us</span></h3>
				</div>
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-8 col-xl-6">
						<div class="contact-form">
							<form action="#">
								<div class="row">
									<div class="col-xl-6">
										<input type="text" placeholder="First Name*">
									</div>
									<div class="col-xl-6">
										<input type="text" placeholder="Last Name*">
									</div>
									<div class="col-xl-6">
										<input type="text" placeholder="Email*">
									</div>
									<div class="col-xl-6">
										<input type="text" placeholder="Website">
									</div>
									<div class="col-xl-12">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
									<div class="col-xl-12">
										<input type="submit" value="SUBMIT">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /.row end -->
			</div>
			<!-- /.container-fluid end -->
		</section>
		<!-- /.contact-area end -->
    </main>
@endsection
