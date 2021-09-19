@extends('layouts.frontend')
@section('title')
Track Page
@endsection
@section('css')
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
                        <h5>Track Your Product</h5>
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
                        {{-- <form action="{{ route('login.post') }}" method="POST" enctype="multipart/form-data"> --}}
                            <ul class="alert alert-danger d-none" id="save_errorList"></ul>
                            <form id="TrackForm" method="POST" class="form">
                            {{-- @csrf --}}
                            
                            <div class="row">
                                <div class="col-12">
                                    <label for="title">Enter Your Tracking Number: (*)</label>
                                    <div class="email">
                                        <input class="form-control" name="track_no" id="track_no" type="text" placeholder="Enter Your Tracking Number">
                                    </div>
                                    @error('track_no')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="submit">
                                <button type="submit" class="btn btn-success">Login</button>
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


<script>
    $(document).ready(function () {

        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit','#TrackForm',function (e)  {
             e.preventDefault();

             let formData = new FormData($('#TrackForm')[0]);
             var id = $('#stateid').val();
             console.log(id);
             $.ajax({
                 type: "POST",
                 url: "/track/order",
                 data: formData,
                 contentType: false,
                 processData: false,
                 cache: false,
                 success: function (response) {
                     if(response.status == 400)
                     {
                        $('#save_errorList').html("");
                        $('#save_errorList').removeClass('d-none');
                        $.each(response.errors, function (key, err_value) { 
                            $('#save_errorList').append('<li>'+err_value+'</li>');
                        });
                     }
                     else if(response.status == 200)
                     {
                        $('#save_errorList').html("");
                        $('#save_errorList').addClass('d-none');
                        $('#TrackForm').find('input').val('');
                        $('#nameid').val("");
                        $('#editModal'+id+'').modal('hide');
                        // alert(response.message);
                        location.reload();
                        alertify.set('notifier','position', 'top-center');
                        alertify.success(response.message);
                     }
                 }
             });
        });
    });
</script>


@endsection