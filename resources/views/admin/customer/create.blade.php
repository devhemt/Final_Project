@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>General Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Account</li>
                    <li class="breadcrumb-item active">Create Account</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create new account</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" accept-charset="utf-8" action="{{url('admin/create_customer')}}" role="form" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Name</label>
                                    <input required name="name" type="text" class="form-control" id="inputNanme4">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input required name="email" type="email" class="form-control" id="inputEmail4">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="inputPhone4" class="form-label">Phone</label>
                                    <input required name="phone" type="tel" class="form-control" id="inputPhone4">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input required name="password" type="password" class="form-control" id="inputPassword4">
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
                                    <select required class="form-select form-select-sm" name="ward" id="ward" aria-label=".form-select-sm">
                                        <option value="" selected>Ward</option>
                                    </select>
                                    @if ($errors->has('ward'))
                                        <span class="text-danger">{{ $errors->first('ward') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="detailed_address" class="form-label">Detailed address</label>
                                    <input required name="detailed_address" type="text" class="form-control" id="detailed_address">
                                    @if ($errors->has('detailed_address'))
                                        <span class="text-danger">{{ $errors->first('detailed_address') }}</span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
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
