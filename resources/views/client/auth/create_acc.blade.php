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
							<p><a href="#">Home  |</a> Create Account</p>
						</div>
					</div>
					<!-- /.col-xl-12 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<!--=========================-->
		<!--=        Login         =-->
		<!--=========================-->



		<!--Login  area
		============================================= -->

		<section class="contact-area">
			<div class="container-fluid custom-container">
				<div class="section-heading pb-30">
					<h3>Create <span>Account</span></h3>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm-9 col-md-8 col-lg-6 col-xl-4">
						<div class="contact-form login-form">
							<form accept-charset="utf-8" action="{{ route('register.custom') }}" role="form" method="POST">
                                @csrf
								<div class="row">
									<div class="col-xl-12">
										<input name="name" type="text" placeholder="Name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
									</div>
									<div class="col-xl-12">
										<input name="email" type="email" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
									</div>
									<div class="col-xl-12">
										<input name="phone" type="tel" placeholder="Phone">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
									</div>
									<div class="col-xl-12">
										<input name="password" type="password" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
									</div>
                                    <div class="col-xl-12">
                                        <select required class="form-select form-select-sm mb-3" name="city" id="city" aria-label=".form-select-sm">
                                            <option value="" selected>City</option>
                                        </select>
                                        @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                        @endif
                                        <select required class="form-select form-select-sm mb-3" name="district" id="district" aria-label=".form-select-sm">
                                            <option value="" selected>District</option>
                                        </select>
                                        @if ($errors->has('district'))
                                            <span class="text-danger">{{ $errors->first('district') }}</span>
                                        @endif
                                        <select required class="form-select form-select-sm mb-3" name="ward" id="ward" aria-label=".form-select-sm">
                                            <option value="" selected>Ward</option>
                                        </select>
                                        @if ($errors->has('ward'))
                                            <span class="text-danger">{{ $errors->first('ward') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-xl-12">
                                        <input name="detailed_address" type="text" placeholder="Detailed address">
                                        @if ($errors->has('detailed_address'))
                                            <span class="text-danger">{{ $errors->first('detailed_address') }}</span>
                                        @endif
                                    </div>
									<div class="col-xl-12">
										<input type="submit" value="CREATE">
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

		<section class="login-now">
			<div class="container-fluid custom-container">
				<div class="col-12">
					<span>Already have account</span>
					<a href="{{ url('login') }}" class="btn-two">Login now</a>
				</div>
				<!-- /.col-12 -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<!-- /.login-now -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        <script>
            var citis = document.getElementById("city");
            var districts = document.getElementById("district");
            var wards = document.getElementById("ward");
            var Parameter = {
                url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
                method: "GET",
                responseType: "application/json",
            };

            var promise = axios(Parameter);
            promise.then(function (result) {
                renderCity(result.data);
            });

            function renderCity(data) {
                for (const x of data) {
                    citis.options[citis.options.length] = new Option(x.Name, x.Id);
                }
                citis.onchange = function () {
                    district.length = 1;
                    ward.length = 1;
                    if(this.value != ""){
                        const result = data.filter(n => n.Id === this.value);

                        for (const k of result[0].Districts) {
                            district.options[district.options.length] = new Option(k.Name, k.Id);
                        }
                    }
                };
                district.onchange = function () {
                    ward.length = 1;
                    const dataCity = data.filter((n) => n.Id === citis.value);
                    if (this.value != "") {
                        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                        for (const w of dataWards) {
                            wards.options[wards.options.length] = new Option(w.Name, w.Id);
                        }
                    }
                };
            }
        </script>
    </main>
@endsection
