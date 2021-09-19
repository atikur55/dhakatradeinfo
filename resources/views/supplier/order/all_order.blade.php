@extends('layouts.dashboard')
@section('title')
All Order 
@endsection
@section('supplier_order')
 menu-item-active
@endsection
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">All Order</h6>
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
						   		<h3 class="card-label">All Order List</h3>
						    </div>

						    <div class="card-toolbar">
							   	<ul class="nav nav-bold nav-pills ml-auto">
								    <li class="nav-item">
								    	 
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
													<th>Track No</th>
													<th>Product Name</th>
													<th>Date & Time</th>
													<th>Status</th>
													<th>Action</th>
													<th>Track and Invoice</th>
												</tr>
											</thead>
											<tbody>
												@php
													$i = 1;
												@endphp
												@foreach($all_order as $order)
												<tr>
													<td>{{$i++}}</td>
													<td>{{$order->track_no??''}}</td>
													<td>{{$order->product_name??''}}</td>
													<td>{{$order->created_at->format('d-m-Y h:i:s A')??''}}</td>
													<td>
														@if ($order->status == 0)
															<span class="badge bg-warning text-white">Pending</span>
														@elseif ($order->status == 1)
															<span class="badge bg-dark text-white">Processing</span>
														@elseif ($order->status == 2)
															<span class="badge bg-primary text-white">Confirm</span>
														@elseif ($order->status == 3)
															<span class="badge bg-secondary text-white">On Going</span>
														@elseif ($order->status == 4)
															<span class="badge bg-success text-white">Delivered</span>
														@else
															<span class="badge bg-danger text-white">Cancel</span>
														@endif
													</td>
													<td>
					                                    <div class="dropdown">
														    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														        Action
														    </button>
														    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														        <a class="dropdown-item text-warning" href="#deliveryModal{{$order->id}}" data-toggle="modal"><i class="flaticon-truck icon-lg"></i>&nbsp;&nbsp;Delivery Status
							                                    </a>
							                                    <a class="dropdown-item text-danger" href="#deleteModal{{$order->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
						                                    	</a>
														    </div>
														</div>
													</td>
													<td>
					                                    <div class="dropdown">
														    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														        Action
														    </button>
														    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														        <a class="dropdown-item text-warning" href="#trackModal{{$order->id}}" data-toggle="modal"><i class="flaticon-map-location icon-lg"></i>&nbsp;&nbsp;Track
							                                    </a>
							                                    <a class="dropdown-item text-danger" href="{{ url('download/order') }}/{{ $order->id }}"><i class="flaticon-file-2 icon-lg"></i> &nbsp;&nbsp;Invoice
						                                    	</a>
														    </div>
														</div>
													</td>
											</tr>

<!-- Delete -->
<div class="modal fade" id="deleteModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('supplier.order.delete', ['id' => $order->id])}}" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Delivery Status Modal -->
<div class="modal fade" id="deliveryModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
				<h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want Change Delivery Status?</h5>
            </div>
			<ul class="alert alert-danger d-none" id="save_errorList"></ul>
				<div class="modal-body">
					<form action="{{ route('supplier.order.status') }}" method="POST">
						@csrf
						<div class="form-group">
							<input type="hidden" name="id" value="{{ $order->id }}">
							<label for="">Delivery Status</label>
							<select name="status" class="form-control">
								<option value="0" {{ $order->status == 0?'selected':'' }}>Pending</option>
								<option value="1" {{ $order->status == 1?'selected':'' }}>Processing</option>
								<option value="2" {{ $order->status == 2?'selected':'' }}>Confirm</option>
								<option value="3" {{ $order->status == 3?'selected':'' }}>On Going</option>
								<option value="4" {{ $order->status == 4?'selected':'' }}>Delivered</option>
								<option value="5" {{ $order->status == 5?'selected':'' }}>Cancel</option>
							</select>
						</div>
						<button type="submit" class="btn btn-dark">Update</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</form>
				</div>
        </div>
    </div>
</div>
<!-- Tracking Modal -->
<div class="modal fade" id="trackModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
				<h5 class="modal-title" id="exampleModalLongTitle">Tracking System on Order</h5>
            </div>
				<div class="modal-body">
					<form action="{{ route('supplier.track.post') }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="">Track Number</label>
							<input type="text" name="track_no" class="form-control" value="{{ $order->track_no??'' }}" readonly>
							<input type="hidden" name="order_id" class="form-control" value="{{ $order->id??'' }}" readonly>
						</div>
						<div class="form-group">
							<label for="">Expected Delivery Date</label>
							<input type="date" name="expect_Date" class="form-control" value="">
							@error('expect_Date')
								<div class="alert alert-danger">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="">Tracking Icon For Status</label>
							<select name="icon" id="" class="form-control">
								<option value="">-- Choose --</option>
								<option value="flaticon-exclamation-2">Pending</option>
								<option value="flaticon-clipboard">Processing</option>
								<option value="flaticon2-check-mark">Confirm</option>
								<option value="flaticon-truck">On Going</option>
								<option value="flaticon-bus-stop">Delivered</option>
							</select>
							@error('icon')
								<div class="alert alert-danger">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="">Tracking Present Status</label>
							<select name="order_status" id="" class="form-control">
								<option value="">-- Choose --</option>
								<option value="Order Pending">Order Pending</option>
								<option value="Order Processed">Order Processed</option>
								<option value="Order Shipped">Order Shipped</option>
								<option value="Order En Route">Order En Route</option>
								<option value="Order Arrived">Order Arrived</option>
							</select>
							@error('order_status')
								<div class="alert alert-danger">
									<strong>{{ $message }}</strong>
								</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="">Short Description</label>
							<textarea name="description" class="form-control" id="" cols="3" rows="4"></textarea>
						</div>
						<button type="submit" class="btn btn-dark">Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					</form>
				</div>
				@php
					$track_list = App\Models\Tracking::where('order_id',$order->id)->get();
				@endphp
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<h3 class="text-center">Tracking Status</h3>
							<ol type="1">
								@foreach($track_list as $track)
								<li>{{ $track->order_status??'' }}</li>
								@endforeach
							</ol>
						</div>
						<div class="col-md-6">
							<h3 class="text-center">Tracking Time</h3>
							<ul>
								@foreach($track_list as $track)
								<li>{{ $track->created_at->format('d-m-Y h:i:s A')??'' }}</li>
								@endforeach
							</ul>
						</div>
					</div>
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

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>s
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

