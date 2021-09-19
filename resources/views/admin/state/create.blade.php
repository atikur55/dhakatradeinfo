@extends('layouts.dashboard')
@section('title')
State Add
@endsection
@section('country')
menu-item-active
@endsection
@section('country')
active
@endsection
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">State Add</h6>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Create New State</h3>
                            </div>

                            <div class="card-toolbar">
                                <ul class="nav nav-bold nav-pills ml-auto">
                                    <li class="nav-item">
                                         <a href="{{route('admin.state.view')}}" class="btn btn-success"><i class="flaticon2-eye icon-lg"></i>View State</a>
                                    </li>
                               </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="alert alert-danger d-none" id="save_errorList"></ul>
                            <form id="AddStateForm" method="POST" enctype="multipart/form-data" class="form">
                                
                                    <div class="form-group">
                                        <label>Country Name</label>
                                        <select name="country_id" class="form-control" id="nameid">
                                            <option value=""></option>
                                            @foreach ($all_country as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_name')
                                        <div class="alert alert-danger">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>State Name</label>
                                        <input type="text" name="state_name" class="form-control" placeholder="State Name">
                                        @error('state_name')
                                        <div class="alert alert-danger">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!--end::Row-->
            <!--end::Dashboard-->
</div>

@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
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
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() { 
        $("#nameid").select2({
            placeholder:"search here",
            allowClear:true,
        }); 
    });
</script>
<!-- JavaScript -->

<script>
    $(document).ready(function () {

        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit','#AddStateForm',function (e)  {
             e.preventDefault();

             let formData = new FormData($('#AddStateForm')[0]);

             $.ajax({
                 type: "POST",
                 url: "/state/post",
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
                        $('#AddStateForm').find('input').val('');
                        $('#nameid').val("");
                        // alert(response.message);
                        alertify.set('notifier','position', 'top-center');
                        alertify.success(response.message);
                     }
                 }
             });
        });
    });
</script>
@endsection