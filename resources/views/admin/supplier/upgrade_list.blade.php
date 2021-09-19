@extends('layouts.dashboard')
@section('title')
Supplier Upgrade List
@endsection
@section('supplier_upgrade')
menu-item-active
@endsection
@section('supplier_upgrade')
active
@endsection
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Supplier Upgrading List</h6>
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
                                <h3 class="card-label">All Supplier Upgrading List</h3>
                            </div>

                            <div class="card-toolbar">
                                <ul class="nav nav-bold nav-pills ml-auto">
                                    <li class="nav-item">
                                         <a href="{{route('supplier.upgrade')}}" class="btn btn-success"><i class="flaticon2-plus-1 icon-lg"></i> Add New Supplier</a>
                                    </li>
                               </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Search Form-->
                                        <!--begin: Datatable-->
                                        <div class="table-responsive">
                                        <table id="usertable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL NO.</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Company Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach($suppliers as $supplier)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$supplier->name}}</td>
                                                    <td>{{$supplier->email}}</td>
                                                    <td>{{$supplier->company_name}}</td>
                                                    <td>
                                                        @if($supplier->status == 0)
                                                        <a href="#statusModal{{$supplier->id}}" data-toggle="modal" class="btn btn-danger"  ><i class="fas fa-toggle-off icon-md"></i>Pending
                                                        </a>
                                                        @else
                                                        <a href="#statusModal{{$supplier->id}}" data-toggle="modal" class="btn btn-success"  ><i class="fas fa-toggle-on icon-md"></i></i> Approve
                                                        </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                {{-- <a class="dropdown-item text-warning" href="{{route('admin.supplier.edit', ['id' => $supplier->id])}}"><i class="flaticon2-edit icon-lg"></i>&nbsp;&nbsp;Edit
                                                                </a> --}}
                                                                @if ($supplier->temp_id == '')
                                                                <a class="dropdown-item text-success" href="#editModal{{$supplier->id}}" data-toggle="modal"><i class="flaticon2-edit icon-lg"></i> &nbsp;&nbsp;Update
                                                                </a>
                                                                @endif
                                                                
                                                                <a class="dropdown-item text-success" href="#showModal{{$supplier->id}}" data-toggle="modal"><i class="flaticon2-eye icon-lg"></i> &nbsp;&nbsp;View
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="#deleteModal{{$supplier->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                            </tr>
<!-- Status Update -->
<div class="modal fade" id="statusModal{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLongTitle">Are You Sure for Change Status?</h5>
            </div>
            <div class="modal-footer">
                @if($supplier->status==0)
                <a href="{{route('admin.supplier_upgrade.status', ['id' => $supplier->id])}}" class="btn btn-success">Approve</a>
                @else
                <a href="{{route('admin.supplier_upgrade.status', ['id' => $supplier->id])}}" class="btn btn-danger">Pending</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="deleteModal{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{route('admin.supplier.delete', ['id' => $supplier->id])}}" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit -->
<div class="modal fade" id="editModal{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to Edit ?</h5>
            </div>
            <div class="modal-body">
                    @php
                    if ($supplier->temp_id=='') 
                    {
                        $template_user_domain = $supplier->user_domain??'';
                        
                        $template_id = App\Models\Template::where('template_url',$template_user_domain)->exists();
                        if($template_id == 1)
                        {
                            $template_info = App\Models\Template::where('template_url',$template_user_domain)->first();
                            $template = $template_info->id;
                            // dd($template);die();
                        }
                        else 
                        {
                           $template = '';
                        }
                    }    
                    @endphp
                <form action="{{ route('admin.supplier_upgrade.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Domain Name</label>
                        <input type="text" class="form-control" name="temp_id" value={{ $template??'' }} readonly>
                        <input type="hidden" class="form-control" name="id" value={{ $supplier->id }} readonly>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>
<!-- Show -->
<div class="modal fade" id="showModal{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h3>About Supplier</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value="{{ $supplier->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" value="{{ $supplier->email }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" value="{{ $supplier->phone }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" value="{{ $supplier->company_name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Payment Type & Number</label>
                    <input type="text" class="form-control" value="{{ $supplier->payment }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Send Account Number</label>
                    <input type="text" class="form-control" value="{{ $supplier->send_account_number }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Tracsaction ID</label>
                    <input type="text" class="form-control" value="{{ $supplier->transactionid }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Reference</label>
                    <input type="text" class="form-control" value="{{ $supplier->reference }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Template Category</label>
                    <input type="text" class="form-control" value="{{ $supplier->connect_template_category->category_name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Supplier Template Demo : </label>
                    {{-- <input type="text" class="form-control" value="{{ $supplier->connect_template->template_url }}"> --}}
                    <a href="{{ $supplier->user_domain??'' }}" target="_blank">{{ $supplier->user_domain??'' }}</a>
                </div>
                <div class="form-group">
                    <label for="">Template Demo : </label>
                    {{-- <input type="text" class="form-control" value="{{ $supplier->connect_template->template_url }}"> --}}
                    <a href="{{ $supplier->connect_template->template_url??'' }}" target="_blank">{{ $supplier->connect_template->template_url??'' }}</a><br>
                    Template ID: {{ $supplier->connect_template->id??'' }}
                </div>
            
            </div>
        </div>
    </div>
</div>


                                                @endforeach
                                            </tbody>
                                        </table>
                                         </div>
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