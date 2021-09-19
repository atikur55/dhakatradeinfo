@extends('layouts.dashboard')
@section('title')
Supplier Upgrade MemberShip
@endsection
@section('upgrade')
menu-item-active
@endsection
@section('upgrade')
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Supplier Add</h6>
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
                                <h3 class="card-label">Create New Suplloer</h3>
                            </div>

                            <div class="card-toolbar">
                                <ul class="nav nav-bold nav-pills ml-auto">
                                    <li class="nav-item">
                                         {{-- <a href="{{route('admin.supplier.view')}}" class="btn btn-success"><i class="flaticon2-eye icon-lg"></i>View Supplier</a> --}}
                                    </li>
                               </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ route('supplier.upgrade.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Supplier Info:</h3>
                                    <div class="mb-15">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Full Name:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="name" placeholder="Enter full name" value="{{Auth::user()->name}}" readonly="" />
                                                 <span class="form-text text-muted">Please enter your full name</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Email address:</label>
                                            <div class="col-lg-6">
                                                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{Auth::user()->email}}" readonly=""/>
                                                <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Phone Number:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="phone" placeholder="Enter Phone" value="{{Auth::user()->phone}}" readonly=""/>
                                                <span class="form-text text-muted">We'll never share your Phone with anyone else</span>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Supplier Company Info:</h3>
                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Company Name:</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" placeholder="Enter full Company name" name="company_name" value="{{$data->company_name??''}}"/>
                                                <span class="form-text text-muted">Please enter your Company Name</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-15">আপনি যদি মেম্বারশিপ পেতে চান তাহলে নিম্নের বিকাশ / রকেট / নগদ নাম্বারে মেম্বার চার্জ পাঠিয়ে  আপনার ট্রানজেক্শন নম্বর এবং একাউন্ট নম্বর নিম্ন ফর্মে  প্রদান করে আবেদন করুন।  আপনার আবেদনের পর আপনার ইমেইলে কনফার্ম মেসেজ যাবে। উক্ত প্রক্রিয়া ১ থেকে ২ দিন সময় লাগতে পারে।</p>
                                <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Payment Info:</h3>
                                <div class="mb-15">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Payment Number:</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="payment" id="mySelect" onchange="myFunction()">
                                                <option value="">--Choose Payment--</option>
                                                <option value="Bkash-01313161xxx">Bkash-01313161xxx</option>
                                                <option value="Rocket-01313161xxx">Rocket-01313161xxx</option>
                                                <option value="Nagad-01313161xxx">Nagad-01313161xxx</option>
                                            </select>
                                             <span class="form-text text-muted">Please enter your full name</span>
                                        </div>
                                    </div>
                                       
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label"></label>
                                        <div class="col-lg-6">
                                            <div class="mb-3 payment_type" id="pay_form" style="display: none;">
                                                <p id="demo" class="font-weight-bold"></p>
                                                <p class="font-weight-bold">টাকা পাঠিয়ে সেন্ডার মোবাইল নাম্বার এবং ট্রানজেকশন আই.ডি পাঠাবেন</p>
                                                <label for="exampleInputEmail1" class="form-label">Sender Account Number</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="send_account_number" placeholder="Account Number">
                                                <label for="exampleInputEmail1" class="form-label">Transection ID</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="transactionid" placeholder="Transection ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Reference:</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="reference" placeholder="Ex:1">
                                            <span class="form-text text-muted">We'll never share your Reference with anyone else</span>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font-size-lg text-dark font-weight-bold mb-6">4. Template Info:</h3>
                                <div class="mb-15">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">If you have any Domain ?</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="user_domain" value="" placeholder="E.g:example.com" class="form-control">
                                             <span class="form-text text-muted">Please enter your domain Link</span>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Your Business Category:</label>
                                        <div class="col-lg-6">
                                            <select name="template_category_id" id="nameid" class="form-control">
                                                <option value="" selected disabled>Select</option>
                                                @foreach($tems as $tem)
                                                <option value="{{$tem->id}}">{{$tem->category_name}}</option>
                                                @endforeach
                                            </select>
                                             <span class="form-text text-muted">Please enter your full name</span>
                                        </div>
                                    </div>
                                   {{--  <select name=subcategory_id id="state" class="form-control">
                                    </select>                   --}}
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label"></label>
                                        <div class="col-lg-3" id="state">
                                           
                                        </div>
                                    </div>

                                     
                                </div>
                            </div>
                                

                               
                            <div class="card-footer">
                              <div class="row">
                               <div class="col-lg-3"></div>
                               <div class="col-lg-6">
                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                               </div>
                              </div>
                            </div>
                                </form>                        </div>
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
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    function myFunction() {
      var x = document.getElementById("mySelect").value;
      document.getElementById('pay_form').style.display='block';
      document.getElementById("demo").innerHTML = "You selected: " + x;
    }
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script type=text/javascript>
  $('#nameid').change(function(){
  var countryID = $(this).val();
  if(countryID){
    $.ajax({
      type:"GET",
      url:'/search-get-state-list/'+countryID,
      data : {"_token":"{{ csrf_token() }}"},
      dataType: "json",
      success:function(res){        
      if(res){
        $("#state").empty();
        $("#state").append('<option>View & Just Select one your choicable Template</option>');
        $.each(res,function(key,value){
        //   $("#state").append('<option value="'+value.id+'">'+value.template_url+'</option>');
            // $("#state").append('<div>'+value.template_url+'</div>');
            // $("#state").append('<a href='+value.template_url+' target="_blank">'"<img "'</a>')
            $("#state").append('<a href='+value.template_url+' target=_blank><img width=200px  src={{ asset('uploads/template') }}/'+value.image+'><input style=margin:10px 0; class=temp_id type=checkbox name=temp_id value='+value.id+'></a>')
         
        });
      
      }else{
        $("#state").empty();
      }
      }
    });
  }else{
    $("#state").empty();
    $("#city").empty();
  }   
  });
  $('#state').on('change',function(){
  var stateID = $(this).val();
  console.log(stateID);
  if(stateID){
    $.ajax({
      type:"GET",
      url:'/get-city-list/'+stateID,
      success:function(res){        
      if(res){
        $("#city").empty();
        $.each(res,function(key,value){
          $("#city").append('<option value="'+value.id+'">'+value.template_url+'</option>');
        });
      
      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }
    
  });
</script>

<script>
    function template(){
      var x = document.getElementById("nameid").value;
      var z = x;

         $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "get-blog-list/"+z,       
          success: function (data) {
            $("#title").html(data.title);
            $("#description").html(data.description);
          }
        });
    }
    // var y = document.getElementById('message').value;
    // console.log(y);

</script>

<script type="text/javascript">
    
    $(document).ready(function() { 
        $("#nameid").select2({
            placeholder:"search here",
            allowClear:true,
        }); 
    });
</script>
@endsection