@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">New update !</h4>
                    <p>Forget Password functionality is working. </p>
                    <hr>
                    <p class="mb-0">Now, you can reset your password.</p>
                </div>
                <div class="card">
                    <div class="card-header">Welcome {{ Auth::user()->username }}</div>



                </div>

                {{-- @dd($attendance_all); --}}
            </div>
        </div>
    </div>
@endsection
