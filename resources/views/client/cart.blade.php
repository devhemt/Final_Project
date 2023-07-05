@extends('layout.default')
@section('content')

<main id="main">
    <section class="h-100 h-custom cart" id="cart">

        <div class="container">
            <div id="visitor-form" class="visitor-form-container">

                <i onclick="closeForm()" class="fas fa-times" id="form-close"></i>

                <form accept-charset="utf-8" action="{{ url("guest/create") }}" method="POST">
                    {{ method_field('POST') }}
                    @csrf
                    <h3>Your information</h3>
                    <input required name="name" type="text" class="box" placeholder="enter your name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <input required name="email" type="email" class="box" placeholder="enter your email">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <input required name="phone" type="tel" class="box" placeholder="enter your phone">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
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
                    <input type="submit" value="confirm" class="btn">
                    <p for="remember">Because you don't have an account, we need you to provide your personal information in order to confirm the order.</p>
                </form>

            </div>

        </div>

            @livewire('client.cart.truecart')

      </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>

        function closeForm(){
            var element = document.getElementById('visitor-form');
            element.style.top = '';
        }
        function openForm(){
            var element = document.getElementById('visitor-form');
            element.style.top = '0';
        }

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
