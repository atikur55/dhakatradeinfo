@extends('layouts.dashboard')
@section('title')
Child Category 
@endsection
@section('category')
 menu-item-active
@endsection
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> --}}
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Child Category</h6>
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
                <div class="col-lg-12">
                    <div class="card card-custom">
					 	<div class="card-header">
						    <div class="card-title">
						   		<h3 class="card-label">Edit Child Category</h3>
						    </div>

						    <div class="card-toolbar">
							   	<ul class="nav nav-bold nav-pills ml-auto">
								    <li class="nav-item">
								    	 <!-- Add Logo-->
					                    <a href="{{ route('admin.childcategory.view') }}" class="btn btn-primary">View All Child Category</a>
								    </li>
							   </ul>
							</div>
						</div>
						<div class="card-body">
                            <form action="{{route('admin.childcategory.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Category Name:</label><br>
                                    <select style="width: 100%;" id="upnameid" class="form-control" name="category_id">
                                        <option value="">Select</option>
                                        @foreach($all_category as $category)
                                        <option value="{{$category->id}}" {{$childcategory->category_id == $category->id ? 'selected':''}}>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-muted">Please select an option.</span>
                                    
                                </div>	
                                <div class="form-group">
                                    <label for="title">Sub-Category Name:</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" style="width:100%;">
                                        <option value="{{ $childcategory->subcategory_id }}">{{ $childcategory->connect_sub_category->title??' '}}</option>
                                    </select>
                                    @error('category_name')
                                    <div class="alert alert-danger">
                                            <strong>{{$mesage}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Child-Category Name:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Child Category Name" value="{{$childcategory->title}}">
                                    <input type="hidden" name="id" class="form-control" placeholder="Child Category Name" value="{{$childcategory->id}}">
                                    @error('category_name')
                                    <div class="alert alert-danger">
                                            <strong>{{$mesage}}</strong>
                                    </div>
                                    @enderror
                                    <span class="form-text text-muted">Please Type an option.</span>
                                </div>
                                <div class="form-group">
                                        <label>Child-Category Photo Browser</label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="image" id="profile-img" onchange="preview_image(event)"/>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <img src="{{asset('uploads/childcategory')}}/{{$childcategory->image}}" id="output_image" width="200px" style="padding-top: 5px;" />
                                        </div>
                                </div>
                                @error('image')
                                    <div class="alert alert-danger">
                                            <strong>{{$mesage}}</strong>
                                    </div>
                                    @enderror
                                <div class="form-group" style="text-align:end;">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                                </div>
                            </form>
										
						</div>
					</div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

@endsection
@section('js')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
{{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('dashboard_assets/js/pages/crud/file-upload/dropzonejs.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
    $(function () {
            $("#usertable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
    });
</script>
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
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function(){
            readURL(this);
        });
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#nameid").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script>
 $(document).ready(function() {
        $('#nameid').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/findCityWithStateID/'+stateID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                        // console.log(data);
                      if(data){
                        $('#subcategory_id').empty();
                        $('#subcategory_id').focus;
                        $('#subcategory_id').append('<option value="">-- Select subcategory_id --</option>'); 
                        $.each(data, function(key, value){
                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.title+ '</option>');
                    });
                  }else{
                    $('#subcategory_id').empty();
                  }
                  }
                });
            }else{
              $('#subcategory_id').empty();
            }
        });
    });
    </script>
    <script>
 $(document).ready(function() {
        $('#upnameid').on('change', function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    url: '/findCityWithStateID/'+stateID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                        // console.log(data);
                      if(data){
                        $('#upsubcategory_id').empty();
                        $('#upsubcategory_id').focus;
                        $('#upsubcategory_id').append('<option value="">-- Select subcategory_id --</option>'); 
                        $.each(data, function(key, value){
                        $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.title+ '</option>');
                    });
                  }else{
                    $('#upsubcategory_id').empty();
                  }
                  }
                });
            }else{
              $('#upsubcategory_id').empty();
            }
        });
    });
    </script>
@endsection
