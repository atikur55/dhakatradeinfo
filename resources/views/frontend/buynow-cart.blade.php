@extends('layouts.frontend')
@section('title')
   Buy Now Product 
@endsection
@section('css')
  <!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>  
@endsection
@section('content')
    <!-- Product Cart Start -->
    <section id="product-card" class="py-3">
        <div class="container-fluid">
            <div class="product-card-bg">
                <div class="row">
                    <div class="col-12">
                        <h3>Your Cart</h3>
                    </div>
                </div>
                <div class="row px-3">

                    <table class="table">
                        <tr class="table-head">
                            <th>Product</th>
                            <th style="align-items: center;">Quantity</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('uploads/product') }}/{{ $productInfo->image??'photo.jpg' }}" alt="Product Image">
                                <p>{{ $productInfo->product_name??'' }}</p>
                            </td>
                            <td class="data-update">
                                {{-- <form action="#"> --}}
                                    {{-- <input value="{{ $total_quantity }}" type="number" id="cart_quantity" name="cart_quantity"> --}}
                                    {{-- <button type="submit">Update</button> --}}
                                {{-- </form> --}}
                                
                                <div class="counter-qty">
                                    <button id="sub" onclick="subFunction()">-</button>
                                    <input type="text" id="qtybox" onchange="myFunction(this.value)"  value="{{ $total_quantity }}">
                                    <button id="add" onclick="addFunction()">+</button>
                                </div>
                                <a href="#">Remove</a>
                            </td>
                                {{-- Quantity --}}
                                <input type="hidden" id="first_pack_quantity" value="{{ $first_pack_quantity }}">
                                <input type="hidden" id="second_pack_quantity" value="{{ $second_pack_quantity }}">
                                <input type="hidden" id="third_pack_quantity" value="{{ $third_pack_quantity }}">
                                {{-- Price --}}
                                <input type="hidden" id="first_package_price" value="{{ $first_package_price }}">
                                <input type="hidden" id="second_package_price" value="{{ $second_package_price }}">
                                <input type="hidden" id="third_package_price" value="{{ $third_package_price }}">
                                {{-- Total Price --}}
                                <input type="hidden" id="total_price" value="{{ $total_price }}">
                                
                            
                            <td class="data-price">
                                <span>$</span> <span id="final_price">{{ $total_price }}</span>
                            </td>
                        </tr>
                    </table>

                    <div class="total-card-cal">
                        <h5>TOTAL: $<span id="final_total_price">{{ $total_price }}</h5>
                        <p>Shipping & taxes calculated at checkout</p>
                        {{-- <a href="{{ route('checkout') }}">Checkout</a> --}}
                        @php
                            $user = Auth::check();
                            // if($user)
                            // {
                            //     dd('ase');
                            // }
                            // else
                            // {
                            //     dd('nai');
                            // }
                        @endphp
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="final_quantity" id="final_quantity" value="">
                            <input type="hidden" name="final_checkout_price" id="final_checkout_price" value="{{ $total_price }}">
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product_id }}">
                            <input type="hidden" name="supplier_id" id="supplier_id" value="{{ $supplier_id }}">
                            @if($user)
                            <p>Your are now login , Please click</p>
                            <button class="log-chk" type="submit">Checkout</button>
                            @else
                            <button type="button" class="log-chk" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Login
                            </button>
                            @endif
                        </form>
<!-- Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="LoginPage" method="POST">
     
              <div class="form-group">
                <label for="">Email Address</label>
                <input type="email" name="email" placeholder="Email Address" class="form-control">
              </div>
              <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="******">
              </div>
              
              <div class="form-group">
                  <button type="submit" class="btn btn-success" id="loginBtn">Login</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Product Cart Start -->
@endsection
@section('js')
<script type="text/javascript">


    let subBtn = document.querySelector('#sub');
    let addBtn = document.querySelector('#add');
    let qty = document.querySelector('#qtybox');
    addBtn.addEventListener('click',()=>{
        qty.value = parseInt(qty.value)+1;
    });
    subBtn.addEventListener('click',()=>{
        qty.value = parseInt(qty.value)-1;
        if(qty.value<0){
            qty.value = 0;
        }
    });
</script>

<script>
    var defaultQuantity = document.getElementById('qtybox').value;
    var intdefaultQuantity = parseInt(defaultQuantity);
    document.getElementById('final_quantity').value = intdefaultQuantity;
    // Quantity Desult Three Section
    var first_pack_quantity = document.getElementById('first_pack_quantity').value;
    var intfirst_pack_quantity = parseInt(first_pack_quantity);

    var second_pack_quantity = document.getElementById('second_pack_quantity').value;
    var intsecond_pack_quantity = parseInt(second_pack_quantity);

    var third_pack_quantity = document.getElementById('third_pack_quantity').value;
    var intthird_pack_quantity = parseInt(third_pack_quantity);
    // Price Desult Three Section
    var first_package_price = document.getElementById('first_package_price').value;
    var intfirst_package_price = parseFloat(first_package_price);

    var second_package_price = document.getElementById('second_package_price').value;
    var intsecond_package_price = parseFloat(second_package_price);

    var third_package_price = document.getElementById('third_package_price').value;
    var intthird_package_price = parseFloat(third_package_price);
    // Condition
    function addFunction()
    {
        var inputValue = document.getElementById('qtybox').value;
        var intinputValue = parseInt(inputValue);
        var increamentValue = intinputValue+1;
        console.log(increamentValue);
        

        if (increamentValue < intsecond_pack_quantity) 
        {

            var calPrice = increamentValue * intfirst_package_price;
            var finalPrice = calPrice.toFixed(2);
            document.getElementById('final_price').innerHTML=finalPrice;
            document.getElementById('final_total_price').innerHTML=finalPrice;
            document.getElementById('final_quantity').value = increamentValue;
            document.getElementById('final_checkout_price').value = finalPrice;
        } 
        else if(increamentValue <= intthird_pack_quantity) 
        {
            var calPrice = increamentValue * intsecond_package_price;
            console.log(calPrice);
            var finalPrice = calPrice.toFixed(2);
            document.getElementById('final_price').innerHTML=finalPrice;
            document.getElementById('final_total_price').innerHTML=finalPrice;
            document.getElementById('final_quantity').value = increamentValue;
            document.getElementById('final_checkout_price').value = finalPrice;
        }
        else
        {
            var calPrice = increamentValue * intthird_package_price;
            var finalPrice = calPrice.toFixed(2);
            document.getElementById('final_price').innerHTML=finalPrice;
            document.getElementById('final_total_price').innerHTML=finalPrice;
            document.getElementById('final_quantity').value = increamentValue;
            document.getElementById('final_checkout_price').value = finalPrice;
        }
    }

    // Sub Button

    function subFunction()
    {
        var inputValue = document.getElementById('qtybox').value;
        var intinputValue = parseInt(inputValue);
        var increamentValue = intinputValue-1;
        console.log(increamentValue);

        var inputValue = document.getElementById('qtybox').value;
        var decrementValue = inputValue - 1;
        if(intfirst_pack_quantity <= decrementValue)
        {
            if(decrementValue < intsecond_pack_quantity)
            {
                var calPrice = decrementValue * intfirst_package_price;
                var finalPrice = calPrice.toFixed(2);
                document.getElementById('final_price').innerHTML=finalPrice;
                document.getElementById('final_total_price').innerHTML=finalPrice;
                document.getElementById('final_quantity').value = decrementValue;
                document.getElementById('final_checkout_price').value = finalPrice;
            }
            else if(decrementValue < intthird_pack_quantity)
            {
                var calPrice = decrementValue * intsecond_package_price;
                var finalPrice = calPrice.toFixed(2);
                document.getElementById('final_price').innerHTML=finalPrice;
                document.getElementById('final_total_price').innerHTML=finalPrice;
                document.getElementById('final_quantity').value = decrementValue;
                document.getElementById('final_checkout_price').value = finalPrice;
            }
            else
            {
                var calPrice = decrementValue * intthird_package_price;
                var finalPrice = calPrice.toFixed(2);
                document.getElementById('final_price').innerHTML=finalPrice;
                document.getElementById('final_total_price').innerHTML=finalPrice;
                document.getElementById('final_quantity').value = decrementValue;
                document.getElementById('final_checkout_price').value = finalPrice;
            }
        }
        else
        {
            var netQuantity = intfirst_pack_quantity+1;
            document.getElementById('qtybox').value = netQuantity;
        }
    }
    function myFunction(val)
    {
        var onVal = val;
        var onquantity = parseInt(onVal);
        if (onquantity < intsecond_pack_quantity) 
        {    
            var calPrice = onquantity * intfirst_package_price;
            var finalPrice = calPrice.toFixed(2);
            document.getElementById('final_price').innerHTML=finalPrice;
            document.getElementById('final_total_price').innerHTML=finalPrice;
            document.getElementById('final_quantity').value = onquantity;
            document.getElementById('final_checkout_price').value = finalPrice;
        } 
        else if(onquantity < intthird_pack_quantity)
        {
            var calPrice = onquantity * intsecond_package_price;
            var finalPrice = calPrice.toFixed(2);
            document.getElementById('final_price').innerHTML=finalPrice;
            document.getElementById('final_total_price').innerHTML=finalPrice;
            document.getElementById('final_quantity').value = onquantity;
            document.getElementById('final_checkout_price').value = finalPrice;
        }
        else
        {
            var calPrice = onquantity * intthird_package_price;
            var finalPrice = calPrice.toFixed(2);
            document.getElementById('final_price').innerHTML=finalPrice;
            document.getElementById('final_total_price').innerHTML=finalPrice;
            document.getElementById('final_quantity').value = onquantity;
            document.getElementById('final_checkout_price').value = finalPrice;
        } 

    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>

$(document).ready(function() {
    $("#loginBtn").click(function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();

        $.ajax({
            url: '{{ route('buyLogin') }}',
            type: 'GET',
            data: {
                email: email,
                password: password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    // alert(data.success);
                    // window.location.href = "/buy-now";
                    $('#exampleModal').modal('hide');
                    
                    location.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success(response.message);

                } else {
                    printErrorMsg(data.error);
                }
            }
        });

    });

    function printErrorMsg(msg) {
        $(".print-error-msg-login").find("ul").html('');
        $(".print-error-msg-login").css('display', 'block');
        $.each(msg, function(key, value) {
            $(".print-error-msg-login").find("ul").append('<li>' + value + '</li>');
        });
    }
});

</script>


@endsection