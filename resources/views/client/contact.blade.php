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
							<p><a href="{{url('')}}">Home  |</a> Contact</p>
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
							<form accept-charset="utf-8" action="{{url('contact')}}" method="POST">
                                {{ method_field('POST') }}
                                @csrf
								<div class="row">
                                    <div class="col-xl-12">
                                        @if ($errors->has('success'))
                                            <span class="text-success">{{ $errors->first('success') }}</span>
                                        @endif
                                            @if ($errors->has('first'))
                                                <span class="text-danger">{{ $errors->first('first') }}</span>
                                            @endif
                                            @if ($errors->has('last'))
                                                <span class="text-danger">{{ $errors->first('last') }}</span>
                                            @endif
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                            @if ($errors->has('message'))
                                                <span class="text-danger">{{ $errors->first('message') }}</span>
                                            @endif
                                    </div>

									<div class="col-xl-6">
										<input name="first" type="text" placeholder="First Name*" required>
									</div>
									<div class="col-xl-6">
										<input name="last" type="text" placeholder="Last Name*" required>
									</div>
									<div class="col-xl-12">
										<input name="email" type="text" placeholder="Email*" required>
									</div>
									<div class="col-xl-12">
										<textarea name="message" placeholder="Message" required></textarea>
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
