@extends('layouts.frontend')
@section('title')
  Checkout Page
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>    
@endsection
@section('content')
<section id="checkout-section" class="py-3">
    <div class="container-fluid">
        <div class="checkout-section-bg">
            <div class="row px-3">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-12">
                            <h3>Dhaka Trade Info</h3>
                        </div>
                    </div>
                    <div class="top">
                        <h5>Order Information</h5>
                        {{-- <h6>Already have an account? <a href="#">Login</a></h6> --}}
                    </div>
                    <div class="information-form">
                        <ul class="alert alert-danger d-none" id="save_errorList"></ul>
                        {{-- <form action="{{ route('checkoutOrder') }}" method="POST"> --}}
                            <form id="AddOrderForm" method="POST" enctype="multipart/form-data">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="email">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="Enter Your Email..." value="{{ Auth::user()->email??'' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <h5>Shipping Address</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="name">
                                        <input class="form-control" type="text" name="name" placeholder="Enter Full Name" value="{{ Auth::user()->name??'' }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="name">
                                        <input class="form-control" type="text" name="phone" placeholder="Enter Your Phone" value="{{ Auth::user()->phone??'' }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-6">
                                    <div class="address">
                                        <textarea name="address" id="" class="form-control" cols="3" rows="4" placeholder="Your Address"></textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="address">
                                        <textarea name="add_require" id="" class="form-control" cols="3" rows="4" placeholder="Your Additional Requirement"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-4">
                                    <div class="country">
                                        {{-- <input class="form-control" type="text" name="country" placeholder="Country Name"> --}}
                                        <label for="title">Country Name: (*)</label>
                                        <select name="country" id="country" class="form-control">
                                            <option value="">-- Choose--</option>
                                            @foreach ($all_country as $country)
                                             <option value="{{ $country->id??'' }}">{{ $country->country_name??'' }}</option>   
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="state">
                                        {{-- <input class="form-control" type="text" name="state" placeholder="State"> --}}
                                        <label for="title">State Name: (*)</label>
                                        <select name="state" id="state" class="form-control">
                                        </select>
                                    </div>
                                    @error('state')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="state">
                                        {{-- <input class="form-control" type="text" name="policeStation" placeholder="Police Station"> --}}
                                        <label for="title">Police Station Name: (*)</label>
                                        <select name="policeStation" id="policeStation" class="form-control">
                                        </select>
                                    </div>
                                    @error('policeStation')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="phone">
                                        <label for="exampleInputEmail1" class="form-label">Payment</label>
                                        <select class="form-control" name="payment" id="mySelect" onchange="myFunction()">
                                            <option value="">--Choose Payment--</option>
                                            <option value="Bkash-01313161xxx">Bkash-01313161xxx</option>
                                            <option value="Rocket-01313161xxx">Rocket-01313161xxx</option>
                                            <option value="Nagad-01313161xxx">Nagad-01313161xxx</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12" id="pay_form" style="display: none">
                                    <div class="phone">
                                        <p id="demo"></p>
                                        <p>টাকা পাঠিয়ে সেন্ডার মোবাইল নাম্বার এবং ট্রানজেকশন আই.ডি পাঠাবেন</p>
                                        <label for="exampleInputEmail1" class="form-label">Sender Account Number</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="send_account_number">
                                        <label for="exampleInputEmail1" class="form-label">Transection ID</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="transactionid">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="saveinfo">
                                        <label for="exampleInputEmail1" class="form-label">Reference</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="reference" placeholder="Ex:1">
                                    </div>
                                </div>
                            </div>
                            <div class="submit">
                                {{-- <a class="continue-shipping" href="#">Place Order</a> --}}
                                <button type="submit" class="btn btn-success">Place Order</button>
                                {{-- <a class="return-card" href="#">Return To Card</a> --}}
                            </div>
                        
                    </div>
                </div>
                <div class="col-md-5 pt-5">
                    <div class="checkout-right">
                        <div class="card-item">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Items</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <img src="{{ asset('uploads/product') }}/{{ $productInfo->image??'photo.jpg' }}" alt="">
                                                <h6>{{ $productInfo->product_name??'' }}</h6>
                                                <input type="hidden" name="product_name" value="{{ $productInfo->product_name??'' }}">
                                                <input type="hidden" name="product_id" value="{{ $productInfo->id??'' }}">
                                                <input type="hidden" name="supplier_id" value="{{ $supplier_id??'' }}">
                                            </div>
                                        </td>
                                        <td> {{ $final_quantity??'' }}</td>
                                        <input type="hidden" name="final_quantity" value="{{ $final_quantity??'' }}">
                                        <td>$ {{ $final_checkout_price??'' }}</td>
                                        <input type="hidden" name="final_checkout_price" value="{{ $final_checkout_price??'' }}">
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout-cal">
                            <div class="sub-price">
                                <h6>Sub Total: </h6><h6>$ {{ $final_checkout_price??'' }}</h6>
                                <input type="hidden" name="sub_total_price" value="{{ $final_checkout_price??'' }}">
                            </div>
                            <div class="sub-price">
                                <h6>Shipping: <span class="text-muted">(Vat & Tax Included)</span></h6><h6>$ 10</h6>
                                <input type="hidden" name="shipp_rate" value="{{ $total_checkout_price??'' }}">
                            </div>
                            <hr>
                            <div class="sub-price">
                                <h6>Total: </h6><h6>$ {{ $total_checkout_price??'' }}</h6>
                                <input type="hidden" name="confirm_total_price" value="{{ $total_checkout_price??'' }}">
                            </div>
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

<!-- Product Cart Start -->
<script>
    function myFunction() {
      var x = document.getElementById("mySelect").value;
      document.getElementById('pay_form').style.display='block';
      document.getElementById("demo").innerHTML = "You selected: " + x;
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script type=text/javascript>
    $('#country').change(function(){
    var countryID = $(this).val();
    if(countryID){
      $.ajax({
        type:"GET",
        url:'/register-get-state-list/'+countryID,
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(res){        
        if(res){
          $("#state").empty();
          $("#state").append('<option value="">No Select</option>');
          $.each(res,function(key,value){
            $("#state").append('<option value="'+value.id+'">'+value.state_name+'</option>');
          });
        
        }else{
          $("#state").empty();
        }
        }
      });
    }else{
      $("#state").empty();
      $("#policeStation").empty();
    }   
    });
    $('#state').on('change',function(){
    var stateID = $(this).val();
    console.log(stateID);
    if(stateID){
      $.ajax({
        type:"GET",
        url:'/register-get-city-list/'+stateID,
        success:function(res){        
        if(res){
          $("#policeStation").empty();
          $("#policeStation").append('<option value="">No Select</option>');
          $.each(res,function(key,value){
            $("#policeStation").append('<option value="'+value.id+'">'+value.police_station+'</option>');
          });
        
        }else{
          $("#policeStation").empty();
        }
        }
      });
    }else{
      $("#policeStation").empty();
    }
      
    });
  </script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#mySelect").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#country").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
<script>
    $(document).ready(function(){
      $('select').select2({
        tags: true,
        tokenSeparators: [',', ' ']
        
      });
    });
</script>
<script>
  $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $(document).on('submit','#AddOrderForm',function (e)  {
           e.preventDefault();

           let formData = new FormData($('#AddOrderForm')[0]);
            console.log(formData);
           $.ajax({
               type: "POST",
               url: "/checkoutOrder",
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
                      $('#AddOrderForm').find('input').val('');
                      $('#country').val('');
                      // $('#nameid').val("");
                      // alert(response.message);
                      
                      alertify.set('notifier','position', 'top-center');
                      alertify.success(response.message);
                      location.reload();
                      window.location.href='/';
                    //   document.getElementById("AddOrderForm").reset();

                   }
               }
           });
      });
  });
</script>
@endsection