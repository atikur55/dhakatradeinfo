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
													<th>Category</th>
													<th>Name</th>
													<th>Price</th>
													<th>Photo</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@php
													$i = 1;
												@endphp
											@foreach($products as $product)
												<tr>
													<td>{{$i++}}</td>
													<td>{{$product->connect_category->category_name??'Null'}}</td>
													<td>{{$product->product_name??'Null'}}</td>
													<td>{{$product->price??'Null'}}&#2547;</td>
													<td><img src="{{asset('uploads/product')}}/{{$product->image}}" alt="" width="80px;"></td>
													<td>
														@if($product->status == 1)
														<a href="#statusModal{{$product->id}}" data-toggle="modal" class="btn btn-danger"  ><i class="fas fa-toggle-off icon-md"></i>Deactive
					                                    </a>
														@else
														<a href="#statusModal{{$product->id}}" data-toggle="modal" class="btn btn-success"  ><i class="fas fa-toggle-on icon-md"></i></i> Active
					                                    </a>
														@endif
													</td>
													<td>
					                                    <div class="dropdown">
														    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														        Action
														    </button>
														    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														    	<a class="dropdown-item text-warning" href="#showModal{{$product->id}}" data-toggle="modal"><i class="flaticon-eye icon-lg"></i>&nbsp;&nbsp;Show
							                                    </a>
														        <a class="dropdown-item text-warning" href="{{route('supplier.product.edit', ['id' => $product->id])}}"><i class="flaticon2-edit icon-lg"></i>&nbsp;&nbsp;Edit
							                                    </a>
							                                    <a class="dropdown-item text-danger" href="#deleteModal{{$product->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
						                                    	</a>
														    </div>
														</div>
													</td>
											</tr>
<!-- Status Update -->
<div class="modal fade" id="statusModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are You Sure for Change Status?</h5>
            </div>
            <div class="modal-footer">
            	@if($product->status==1)
                <a href="{{route('supplier.product.status', ['id' => $product->id])}}" class="btn btn-success">Active</a>
                @else
                <a href="{{route('supplier.product.status', ['id' => $product->id])}}" class="btn btn-danger">Deactive</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('supplier.product.delete', ['id' => $product->id])}}" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Show -->
<div class="modal fade " id="showModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Product Information</h5>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
              	<form action="{{url('admin/update/product')}}" method="POST" enctype="multipart/form-data">
			                                   		@csrf

			                           <div class="form-group row">
											   	<div class="col-lg-12">
												   <label>Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_business->business_name??''}}" />
											   	</div>
										</div>
									  	<div class="form-group row">
											   	<div class="col-lg-4">
												   <label>Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_category->category_name??''}}" />
											   	</div>
											   <div class="col-lg-4">
												   <label>Sub-Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_subcategory->title??'Null'}}" />
											   	</div>
											   <div class="col-lg-4">
												   <label>Sub-Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_childcategory->title??'Null'}}" />
											   	</div>
										</div>
									  	<div class="form-group row">
											   	<div class="col-lg-6">
												   <label>Product Name</label>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->product_name}}" />
												   <input type="hidden" name="id" class="form-control form-control-solid" value="{{$product->id}}"/>
												   <span class="form-text text-muted">Please enter your Product Name</span>
											   	</div>
											   <div class="col-lg-3">
												    <label>Price in Dollar:</label>
												   <input type="text" class="form-control form-control-solid" name="price" value="{{$product->price_dollar}}"/>
												   <span class="form-text text-muted">Please enter your Price</span>
											   </div>
											   <div class="col-lg-3">
												<label>Price in Taka:</label>
											   <input type="text" class="form-control form-control-solid" name="price" value="{{$product->price}}"/>
											   <span class="form-text text-muted">Please enter your Price</span>
										   </div>
										</div>
										<div class="form-group row">
											<div class="col-lg-6">
												<label>Country of Origin</label>
												<input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->country_origin}}"/>
											</div>
											<div class="col-lg-6">
												<label>Brand Name</label>
												<input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->brand_name}}"/>
											</div>
											<div class="col-lg-3">
											 	<label>Product Color:</label>
												<input type="text" class="form-control form-control-solid" name="color" value="{{$product->color}}"/>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-6">
												<label>Product ID</label>
												<input type="text" name="product_code" class="form-control form-control-solid" value="{{$product->product_code}}"/>
											</div>
											<div class="col-lg-3">
											 	<label>Product Quantity:</label>
												<input type="text" class="form-control form-control-solid" name="price" value="{{$product->product_quantity}}"/>
											</div>
											<div class="col-lg-3">
												<label>Minimum Order Quantity:</label>
											   <input type="text" class="form-control form-control-solid" name="price" value="{{$product->min_order_quantity}}"/>
										   </div>
										</div>
										<div class="form-group row">
											<div class="col-lg-4">
												<label>Step One </label>
												<input type="text" name="product_quantity_one" class="form-control form-control-solid" placeholder="E.g: 2 - 100 (piece)" value="{{ $product->product_quantity_one }}"/>
											</div>
											<div class="col-lg-4">
											  <label>Product Price in Taka </label>
											  <input type="text" name="product_price_one" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_one }}"/>
											</div>
											<div class="col-lg-4">
												<label>Product Price in Dollar </label>
												<input type="text" name="product_price_one" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_one_dollar??'' }}"/>
											</div>
										 </div>
		
										 <div class="form-group row">
										  <div class="col-lg-4">
											  <label>Step Two</label>
											  <input type="text" name="product_quantity_two" class="form-control form-control-solid" placeholder="E.g: 101 - 499 (piece)" value="{{ $product->product_quantity_two }}"/>
										  </div>
										  <div class="col-lg-4">
											<label>Product Price in Taka </label>
											<input type="text" name="product_price_two" class="form-control form-control-solid" placeholder="E.g: $410/(piece)" value="{{ $product->product_price_two }}"/>
										  </div>
										  <div class="col-lg-4">
											<label>Product Price in Dollar </label>
											<input type="text" name="product_price_one" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_two_dollar??'' }}"/>
										  </div>
									   </div>
		
									   <div class="form-group row">
										<div class="col-lg-4">
											<label>Step Three</label>
											<input type="text" name="product_quantity_three" class="form-control form-control-solid" placeholder="E.g: >=500 (piece)" value="{{ $product->product_quantity_three }}"/>
										</div>
										<div class="col-lg-4">
										  <label>Product Price in Taka </label>
										  <input type="text" name="product_price_three" class="form-control form-control-solid" placeholder="E.g: $380/(piece)" value="{{ $product->product_price_three }}"/>
										</div>
										<div class="col-lg-4">
											<label>Product Price in Dollar </label>
											<input type="text" name="product_price_one" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_two_dollar??'' }}"/>
										  </div>
									 </div>
									 <div class="form-group mt-5">
										<label>Video</label>
										<p>{!! $product->video_link !!}</p>
									</div>
									<div class="form-group mt-5">
										<label>Description</label>
										{{-- <textarea name="description">{!! $product->description !!}</textarea> --}}
										<p>{!! $product->description !!}</p>
									</div>
			                            <div class="form-group">
												<label>Product Photo</label>
												<div></div>
												<div class="custom-file">
													<img src="{{asset('uploads/product')}}/{{$product->image}}" id="output_photo" width="200px" style="padding-top: 5px;" />
												</div>
										</div>
										@error('image')
										   <div class="alert alert-danger">
										   		<strong>{{$mesage}}</strong>
										   </div>
										   @enderror
										<div class="form-group" style="text-align:end;">
											<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
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