@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>General Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">General</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create new staff</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" accept-charset="utf-8" action="{{url('admin/profile')}}" role="form" method="POST">
                            @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">Your Name</label>
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
                                <div class="col-12">
                                    <select name="role" id="inputState" class="form-select">
                                        <option value="1" selected>Director</option>
                                        <option value="2">Total Manager</option>
                                        <option value="3">Import Manager</option>
                                        <option value="4">Order Manager canceled</option>
                                        <option value="5">Order Manager noprocess</option>
                                        <option value="6">Order Manager confirmed</option>
                                        <option value="7">Order Manager packing</option>
                                        <option value="8">Order Manager success</option>
                                        <option value="9">Delivery Manager</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
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

    </main>
@endsection
