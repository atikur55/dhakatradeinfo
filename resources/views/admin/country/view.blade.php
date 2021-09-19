@extends('layouts.dashboard')
@section('title')
Country List
@endsection
@section('country')
menu-item-active
@endsection
@section('country')
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Country List</h6>
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
                                <h3 class="card-label">All Country List</h3>
                            </div>

                            <div class="card-toolbar">
                                <ul class="nav nav-bold nav-pills ml-auto">
                                    <li class="nav-item">
                                         <a href="{{route('admin.country.create')}}" class="btn btn-success"><i class="flaticon2-plus-1 icon-lg"></i> Add New Country</a>
                                    </li>
                               </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Search Form-->
                                        <!--begin: Datatable-->
                                        {{-- <div class="table-responsive"> --}}
                                        <table id="usertable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL NO.</th>
                                                    <th>Country Name</th>
                                                    <th>Flug</th>
                                                    <th>Status</th>
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
                                                    <td>{{$data->country_name}}</td>
                                                    <td>
                                                        <img src="{{asset('uploads/country')}}/{{$data->image}}" width="100px;" alt="">
                                                    </td>
                                                    <td>
                                                        @if($data->status == 0)
                                                        <a href="#statusModal{{$data->id}}" data-toggle="modal" class="btn btn-success"  ><i class="fas fa-toggle-off icon-md"></i>Active
                                                        </a>
                                                        @else
                                                        <a href="#statusModal{{$data->id}}" data-toggle="modal" class="btn btn-danger"  ><i class="fas fa-toggle-on icon-md"></i></i> Inactive
                                                        </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                
                                                                <a class="dropdown-item text-danger" href="#editModal{{$data->id}}" data-toggle="modal"><i class="flaticon2-edit icon-lg"></i> &nbsp;&nbsp;Edit
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="#deleteModal{{$data->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                            </tr>
<!-- Status Update -->
<div class="modal fade" id="statusModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are You Sure for Change Status?</h5>
            </div>
            <div class="modal-footer">
                @if($data->status==0)
                <a href="{{route('admin.country.status', ['id' => $data->id])}}" class="btn btn-danger">Inactive</a>
                @else
                <a href="{{route('admin.country.status', ['id' => $data->id])}}" class="btn btn-success">Active</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
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
                <a href="{{route('admin.country.delete', ['id' => $data->id])}}" class="btn btn-danger">Delete</a>
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
                <form action="{{route('admin.country.update')}}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                        
                        <div class="form-group">
                            <label>Country Name</label>
                            <input type="text" class="form-control" name="country_name" placeholder="Country Name" value="{{ $data->country_name }}"/>
                            <input type="hidden" class="form-control" name="id" placeholder="Country Name" value="{{ $data->id }}"/>
                            <span class="form-text text-muted">We'll never share your Country Name with anyone else</span>
                            @error('country_name')
                            <div class="alert alert-danger">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Country Photo [* Photo size 1Mb ]</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="image" id="profile-img" onchange="preview_image(event)"/>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <img src="{{ asset('uploads/country') }}/{{ $data->image }}" id="output_image" width="200px" style="padding-top: 5px;"/>
                            </div>
                            @error('image')
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


                                                @endforeach
                                            </tbody>
                                        </table>
                                         {{-- </div> --}}
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