@extends('layouts.login-app')

{{-- @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}







@extends('layouts.login-app')

@section('content')
    <div class=" auth ">
        <div class="align-items-center row">
            <div class="col-lg-4 mx-auto">
                <div class="logo mb-3">
                    <img src="{{ frontImage('logo-gradian.png') }}" alt="logo">
                </div>
                <h4 class="">Hello! let's get started</h4>
                <h6 class=" font-weight-light">Sign in to continue.</h6>

            </div>
            <div class="col-lg-4 mx-auto">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="auth-form-light br-30 px-4 px-sm-5 py-5 text-left">
                    <div class="brand-logo">
                        <img src="{{ frontImage('logo-gradian.png') }}" alt="logo">
                    </div>
                    <h4 class="text-black">Hello! let's get started</h4>
                    <h6 class="text-black font-weight-light">Sign in to continue.</h6>
                    <form class="pt-3" method="POST" action="{{ route('password.email') }}">
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

                        <div class="mt-3">
                            <button type="submit"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Send Password
                                Reset Link</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
