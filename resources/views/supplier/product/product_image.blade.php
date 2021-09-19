@extends('layouts.dashboard')
@section('title')
Supplier List
@endsection
@section('supplier_product')
menu-item-active
@endsection
@section('supplier_product')
active
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Product List</h6>
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
                                <h3 class="card-label">All Product List</h3>
                            </div>

                            <div class="card-toolbar">
                                <ul class="nav nav-bold nav-pills ml-auto">
                                    <li class="nav-item">
                                         <a href="{{route('supplier.product.create')}}" class="btn btn-success"><i class="flaticon2-plus-1 icon-lg"></i> Add New Product</a>
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
													<th>SL No.</th>
													<th>Product Name</th>
													<th>Photo</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@php
													$i = 1;
												@endphp
											@foreach($datas as $data)
												<tr>
													<td>{{$i++}}</td>
													<td>{{$data->connect_product->product_name??'Null'}}</td>
													<td><img src="{{asset('uploads/product/product_details')}}/{{$data->product_multiple_photo_name??''}}" alt="" width="80px;"></td>
													
													<td>
					                                    <div class="dropdown">
														    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														        Action
														    </button>
														    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item text-warning" href="#editModal{{$data->id}}" data-toggle="modal"><i class="flaticon2-edit icon-lg"></i> &nbsp;&nbsp;Edit
						                                    	</a>
							                                    <a class="dropdown-item text-danger" href="#deleteModal{{$data->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
						                                    	</a>
														    </div>
														</div>
													</td>
											</tr>


<!-- Delete -->
<div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('supplier.product.product_image_delete', ['id' => $data->id])}}" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to Update ?</h5>
            </div>
            <div class="modal-body m-auto">
                <form action="{{ route('supplier.product.product_image_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="product_id" value="{{ $data->product_id }}">
                    </div>
                    <div class="form-group">
                        <label for="">Product Image</label>
                        <input type="file" name="product_multiple_photo" class="form-control">
                        
                    </div>
                    <div class="mt-5">
                        <img src="{{ asset('uploads/product/product_details') }}/{{ $data->product_multiple_photo_name }}" alt="" width="100px;">
                    </div>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function () {
            $("#usertable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
    });
</script>

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