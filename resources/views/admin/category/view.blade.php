@extends('layouts.dashboard')
@section('title')
Category 
@endsection
@section('category')
 menu-item-active
@endsection
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Category</h6>
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
						   		<h3 class="card-label">All Category List</h3>
						    </div>

						    <div class="card-toolbar">
							   	<ul class="nav nav-bold nav-pills ml-auto">
								    <li class="nav-item">
								    	 <!-- Add Logo-->
					                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
					                        <i class="flaticon2-plus-1 icon-lg"></i> Add New Category
					                    </button>

					                    <!-- Modal-->
					                    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
					                        <div class="modal-dialog modal-lg" role="document">
					                            <div class="modal-content">
					                                <div class="modal-header">
					                                    <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
					                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <i aria-hidden="true" class="ki ki-close"></i>
					                                    </button>
					                                </div>
					                                <div class="modal-body">
					                                   	<form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
					                                   		@csrf
													<div class="form-group">
														<label>Business Type Name:</label><br>
														<select name="business_id" class="form-control" id="name_id" style="width: 100%;">
															<option value="">Select</option>
															@foreach ($all_business as $data)
																<option value="{{ $data->id }}">{{ $data->business_name }}</option>
															@endforeach
														</select>
														@error('category_name')
														<div class="alert alert-danger">
																<strong>{{$mesage}}</strong>
														</div>
														@enderror
													</div>
					                            <div class="form-group">
												   <label>Category Name:</label>
												   <input type="text" class="form-control form-control-solid" name="category_name" placeholder="Category Name"/>
												   <span class="form-text text-muted">Please enter your Category Name</span>
												   @error('category_name')
												   <div class="alert alert-danger">
												   		<strong>{{$mesage}}</strong>
												   </div>
												   @enderror
											  	</div>
					                            <div class="form-group">
														<label>Category Photo Browser</label>
														<div></div>
														<div class="custom-file">
															<input type="file" class="custom-file-input" id="customFile" name="image" id="profile-img" onchange="preview_image(event)"/>
															<label class="custom-file-label" for="customFile">Choose file</label>
															<img src="" id="output_image" width="200px" style="padding-top: 5px;" />
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
								    </li>
							   </ul>
							</div>
						</div>
						<div class="card-body">
						  	<!--begin: Search Form-->
										<!--begin: Datatable-->
										<table id="usertable" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>SL NO.</th>
													<th>Business Name</th>
													<th>Name</th>
													<th>Photo</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@php
													$i = 1;
												@endphp
												@foreach($all_category as $category)
												<tr>
													<td>{{$i++}}</td>
													<td>{{$category->connect_business->business_name??''}}</td>
													<td>{{$category->category_name}}</td>
													
													<td><img src="{{asset('uploads/category')}}/{{$category->image}}" alt="" width="80px;"></td>
													<td>
														@if($category->status == 1)
														<a href="#statusModal{{$category->id}}" data-toggle="modal" class="btn btn-danger"  ><i class="fas fa-toggle-off icon-md"></i>Deactive
					                                    </a>
														@else
														<a href="#statusModal{{$category->id}}" data-toggle="modal" class="btn btn-success"  ><i class="fas fa-toggle-on icon-md"></i></i> Active
					                                    </a>
														@endif
													</td>
													<td>
					                                    <div class="dropdown">
														    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														        Action
														    </button>
														    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														        <a class="dropdown-item text-warning" href="#editModal{{$category->id}}" data-toggle="modal"><i class="flaticon2-edit icon-lg"></i>&nbsp;&nbsp;Edit
							                                    </a>
							                                    <a class="dropdown-item text-danger" href="#deleteModal{{$category->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
						                                    	</a>
														    </div>
														</div>
													</td>
											</tr>
<!-- Status Update -->
<div class="modal fade" id="statusModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are You Sure for Change Status?</h5>
            </div>
            <div class="modal-footer">
            	@if($category->status==1)
                <a href="{{route('admin.category.status', ['id' => $category->id])}}" class="btn btn-success">Active</a>
                @else
                <a href="{{route('admin.category.status', ['id' => $category->id])}}" class="btn btn-danger">Deactive</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.category.delete', ['id' => $category->id])}}" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade " id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to Edit ?</h5>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data">
		            @csrf
					<div class="form-group">
						<label>Business Type Name:</label><br>
						<select name="business_id" class="form-control" id="name_id" style="width: 100%;">
							<option value="">Select</option>
							@foreach ($all_business as $data)
								<option value="{{ $data->id }}" {{ $category->business_id == $data->id ? 'selected':'' }}>{{ $data->business_name }}</option>
							@endforeach
						</select>
						@error('category_name')
						<div class="alert alert-danger">
								<strong>{{$mesage}}</strong>
						</div>
						@enderror
					</div>
		            <div class="form-group">

					   <label>Category Name:</label>
					   <input type="text" class="form-control form-control-solid" name="category_name" value="{{$category->category_name}}" />
					   <input type="hidden" class="form-control form-control-solid" name="id" value="{{$category->id}}" />
					   <span class="form-text text-muted">Please enter your Category Name</span>
					   @error('category_name')
					   <div class="alert alert-danger">
					   		<strong>{{$mesage}}</strong>
					   </div>
					   @enderror
				  	</div>
		            <div class="form-group">
							<label>Category Photo Browser</label>
							<div></div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="image" id="profile-img" onchange="preview_image(event)"/>
								<label class="custom-file-label" for="customFile">Choose file</label>
								<img src="{{asset('uploads/category')}}/{{$category->image}}" id="output_image" width="200px" style="padding-top: 5px;" />
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
												@endforeach
											</tbody>
										</table>
										<!--end: Datatable-->
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
		$("#name_id").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>

@endsection
