@extends('admin.layouts.login-app')

@section('content')
    <div class=" auth ">
        <div class="align-items-center row">

            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light br-30 px-4 px-sm-5 py-5 text-left">
                    <div class="brand-logo">
                        <img src="{{ frontImage('logo-gradian.png') }}" alt="logo">
                    </div>
                    <h4 class="text-black">Hello! let's get started</h4>
                    <h6 class="text-black font-weight-light">Sign in to continue.</h6>
                    <form class="pt-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" id="exampleInputEmail1"
                                class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">



                            <input id="password" type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                                id="exampleInputPassword1" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
