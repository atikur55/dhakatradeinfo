@extends('layouts.frontend')
@section('title')
Registration Form
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/> 
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<style>
    label{
        font-size: 18px;
        font-weight: 500;
        font-family: system-ui;
    }    
</style> 
@endsection
@section('content')
<section id="checkout-section" class="py-3">
    <div class="container-fluid">
        <div class="checkout-section-bg">
            <div class="row px-3">
                <div class="col-md-6 m-auto">
                    <div class="row">
                        <div class="col-12">
                            <h3>Dhaka Trade Info</h3>
                        </div>
                    </div>
                    <div class="top">
                        <h5>Registration Form</h5>
                        {{-- <h6>Already have an account? <a href="{{ route('custom.login') }}">Login</a></h6> --}}
                    </div>
                    <div class="information-form">
                        <ul class="alert alert-danger d-none" id="save_errorList"></ul>
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Full Name: (*)</label>
                                    <div class="name">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Your Full Name...">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Email Address: (*)</label>
                                    <div class="email">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Enter Your Full Email...">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Phone Number: (*)</label>
                                    <div class="phone">
                                        <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter Your Full Phone...">
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Password: (*)</label>
                                    <div class="password">
                                        <input class="form-control" name="password" id="password" type="password" placeholder="Enter Your password..." value="">
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Confirm Password: (*)</label>
                                    <div class="password">
                                        <input class="form-control" name="password_confirmation" id="password" type="password" placeholder="Enter Your Confirm password..." value="">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Photo:</label>
                                    <div class="password">
                                       <input type="file" name="image" class="form-control">
                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="submit">
                                <button type="submit" class="btn btn-success">Register</button>
                                <p class="mt-2">Already Register? <a href="{{ route('custom.login') }}">Login Here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@if(Session::has('message'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
  toastr.success("{{ session('message') }}");
@endif
@if(Session::has('message'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
  toastr.error("{{ session('message') }}");
@endif
@endsection