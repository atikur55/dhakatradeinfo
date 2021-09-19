@extends('layouts.dashboard')
@section('title')
Product Edit
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Product Update</h6>
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
                                <h3 class="card-label">Update Product</h3>
                            </div>

                            <div class="card-toolbar">
                                <ul class="nav nav-bold nav-pills ml-auto">
                                    <li class="nav-item">
                                         <a href="{{route('supplier.product.view')}}" class="btn btn-success"><i class="flaticon2-eye icon-lg"></i>View Product</a>
                                    </li>
                               </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('supplier.product.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <div class="col-lg-4">
                                        <label>Business Name:</label><br>
                                        <select id="business" name="business_id"  class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($all_business as $business)
                                            <option value="{{$business->id}}" {{ $product->business_id == $business->id ?'selected' : '' }}>{{$business->business_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                {{-- </div>
                                <div class="form-group row"> --}}
                                    <div class="col-lg-4">
                                        <label>Category Name:</label><br>
                                        <select id="country" name="category_id"  class="form-control">
                                          <option value="{{$product->category_id}}">{{$product->connect_category->category_name??''}}</option>
                                            {{-- <option value="" selected disabled>Select</option>
                                            @foreach($all_category as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{-- <div class="col-lg-4">
                                        <label>Category Name:</label><br>
                                        <select id="category_id" name="category_id"  class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($all_category as $category)
                                            <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}}>{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Please select an option.</span>
                                    </div> --}}
                                    {{-- <div class="col-lg-4">
                                        <label for="title">Sub-Category Name:</label>
                                        <select name=subcategory_id id="subcategory_id" class="form-control">
                                            <option value="{{$product->subcategory_id}}">{{$product->connect_subcategory->title??''}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="title">Child-Category Name:</label>
                                        <select name=childcategory_id id="childcategory_id" class="form-control">
                                            <option value="{{$product->childcategory_id}}">{{$product->connect_childcategory->title??''}}</option>
                                        </select>
                                    </div> --}}
                                    <div class="col-lg-4">
                                      <label for="title">Sub-Category Name:</label>
                                      <select name=subcategory_id id="state" class="form-control">
                                          <option value="{{$product->subcategory_id}}">{{$product->connect_subcategory->title??''}}</option>
                                      </select>
                                  </div>
                                  <div class="col-lg-4">
                                      <label for="title">Child-Category Name:</label>
                                      <select name=childcategory_id id="city" class="form-control">
                                          <option value="{{$product->childcategory_id}}">{{$product->connect_childcategory->title??''}}</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-lg-6">
                                      <label>Product Name</label>
                                      <input type="text" name="product_name" class="form-control form-control-solid" placeholder="Product Name" value="{{ $product->product_name??'' }}"/>
                                      <input type="hidden" name="id" value="{{ $product->id }}"/>
                                      <span class="form-text text-muted">Please enter your Product Name</span>
                                      @error('product_name')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                  </div>

                                  <div class="col-lg-3">
                                    <label>Price in Taka:</label>
                                    <input type="text" class="form-control form-control-solid" id="price_taka" name="price" placeholder="85196.93" value="{{ $product->price??'' }}" onchange="myFunctiontaka(this.value)"/>
                                    <span class="form-text text-muted">Please enter your Price in Taka</span>
                                    @error('price')
                                      <div class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>
                                  <div class="col-lg-3">
                                      <label>Price in Dollar:</label>
                                      <input type="text" class="form-control form-control-solid" id="price_dollar" name="price_dollar" onchange="myFunction(this.value)" placeholder="1000" value="{{ $product->price_dollar??'' }}"/>
                                      <span class="form-text text-muted">Please enter your Price in Dollar</span>
                                      @error('price_dollar')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                  </div>
                                  
                              </div>
                              <div class="form-group row">

                                <div class="col-lg-4">
                                  <label>Country of Origin Name</label>
                                  <select class="form-control" class="country_origin" id="country_origin" name="country_origin">
                                    <option value="{{ $product->country_origin??'' }}" selected="selected">{{ $product->country_origin??'' }}</option>
                                  </select>
                                    @error('country_origin')
                                      <div class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label>Brand Name</label>
                                    {{-- <input type="text" name="brand_name" class="form-control form-control-solid"/> --}}
                                    <select class="form-control" class="brand_name" id="brand_name" name="brand_name" multiple="multiple">
                                        <option value="{{ $product->brand_name }}" selected="selected" >{{ $product->brand_name }}</option>
                                    </select>
                                    <span class="form-text text-muted">Please enter your Brand Name</span>
                                      @error('brand_name')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>Product Color:</label>
                                    @php
                                        $color_data = $product->color;
                                        $color = explode(",",$product->color);
                                        $color_count = count($color);
                                    @endphp
                                    <select class="form-control" class="color" name="color[]" multiple="multiple">
                                      @for ($i = 0; $i < $color_count; $i++)
                                        <option value="{{ $color[$i] }}" selected="selected" >{{ $color[$i] }}</option>
                                      @endfor
                                      {{-- <option value="Black" >Black</option>
                                      <option value="Green" >Green</option>
                                      <option value="Grey" >Grey</option>
                                      <option value="White" >White</option>
                                      <option value="Blue" >Blue</option>
                                      <option value="Yellow" >Yellow</option> --}}
                                    </select>
                                    <span class="form-text text-muted">Please enter your Product Color</span>
                                      @error('color')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                </div>
                               </div>
                              <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Product ID</label>
                                    <input type="text" name="product_code" class="form-control form-control-solid" placeholder="E.g: KE-10" value="{{ $product->product_code??'' }}"/>
                                    <span class="form-text text-muted" >Please enter your Product Code</span>
                                      @error('product_code')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                </div>
                                  <div class="col-lg-4">
                                    <label>Product Quantity</label>
                                    <input type="text" name="product_quantity" placeholder="E.g: 200" class="form-control form-control-solid" value="{{ $product->product_quantity??'' }}"/>
                                    <span class="form-text text-muted">Please enter your Brand Name</span>
                                      @error('product_quantity')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label>Minimum Order Quantity</label>
                                    <input type="text" name="min_order_quantity" placeholder="E.g: 2" class="form-control form-control-solid" value="{{ $product->min_order_quantity??'' }}"/>
                                    <span class="form-text text-muted">Please enter your Brand Name</span>
                                      @error('min_order_quantity')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                </div>
                               </div>
                               <div class="my-5">
                                <h3>Product Quantity With Price List</h3>
                               </div>

                               <div class="form-group row">
                                  <div class="col-lg-4">
                                      <label>Step One </label>
                                      <input type="text" name="product_quantity_one" class="form-control form-control-solid" placeholder="E.g: 2 - 100 (piece)" value="{{ $product->product_quantity_one??'' }}"/>
                                      <span class="form-text text-muted">Please enter your First Product Quantity</span>
                                        @error('product_quantity_one')
                                          <div class="alert alert-danger">
                                            <strong>{{ $message }}</strong>
                                          </div>
                                        @enderror
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Price in taka(&#2547;) </label>
                                    <input type="text" name="product_price_one" id="product_price_one" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_one??'' }}" onchange="priceonetaka(this.value)"/>
                                      @error('product_price_one')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Price in Dollar($) </label>
                                    <input type="text" name="product_price_one_dollar" id="product_price_one_dollar" onchange="priceonedollar(this.value)" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_one_dollar??'' }}"/>
                                      @error('product_price_one')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                  </div>
                               </div>

                               <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Step Two</label>
                                    <input type="text" name="product_quantity_two" class="form-control form-control-solid" placeholder="E.g: 101 - 499 (piece)" value="{{ $product->product_quantity_two??'' }}"/>
                                    <span class="form-text text-muted">Please enter your Second Product Quantity</span>
                                      @error('product_quantity_two')
                                        <div class="alert alert-danger">
                                          <strong>{{ $message }}</strong>
                                        </div>
                                      @enderror
                                </div>
                                <div class="col-lg-4">
                                  <label>Price in taka(&#2547;)</label>
                                  <input type="text" name="product_price_two" id="product_price_two" class="form-control form-control-solid" placeholder="E.g: $410/(piece)" value="{{ $product->product_price_two??'' }}" onchange="pricetwotaka(this.value)"/>
                                    @error('product_price_two')
                                      <div class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                  <label>Price in Dollar($) </label>
                                  <input type="text" name="product_price_two_dollar" id="product_price_two_dollar" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_two_dollar??'' }}" onchange="pricetwodollar(this.value)"/>
                                    @error('product_price_one')
                                      <div class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                                </div>
                             </div>

                             <div class="form-group row">
                              <div class="col-lg-4">
                                  <label>Step Three</label>
                                  <input type="text" name="product_quantity_three" class="form-control form-control-solid" placeholder="E.g: >=500 (piece)" value="{{ $product->product_quantity_three??'' }}"/>
                                    @error('product_quantity_three')
                                      <div class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                      </div>
                                    @enderror
                              </div>
                              <div class="col-lg-4">
                                <label>Price in taka(&#2547;)</label>
                                <input type="text" name="product_price_three" id="product_price_three" class="form-control form-control-solid" placeholder="E.g: $380/(piece)" value="{{ $product->product_price_three??'' }}" onchange="pricethreetaka(this.value)"/>
                                  @error('product_price_three')
                                    <div class="alert alert-danger">
                                      <strong>{{ $message }}</strong>
                                    </div>
                                  @enderror
                              </div>
                              <div class="col-lg-4">
                                <label>Price in Dollar($) </label>
                                <input type="text" name="product_price_three_dollar" id="product_price_three_dollar" class="form-control form-control-solid" placeholder="E.g: $430/(piece)" value="{{ $product->product_price_three_dollar??'' }}" onchange="pricethreedollar(this.value)"/>
                                  @error('product_price_one')
                                    <div class="alert alert-danger">
                                      <strong>{{ $message }}</strong>
                                    </div>
                                  @enderror
                              </div>
                           </div>

                               

                              <div class="form-group mt-5">
                                  <label>Have you any Video ?</label>
                                  <textarea rows="4" cols="3" class="form-control" placeholder="Enter Embeded Code" name="video_link">{!! $product->video_link??'' !!}</textarea>
                              </div>

                              <div class="form-group mt-5">
                                  <label>Description</label>
                                  <textarea id="summernote" name="description">{!! $product->description??'' !!}</textarea>
                              </div>
                              @php
                                  $user_id = Auth::id();
                                  $supplier_id = App\Models\SupplierUpgrade::where('user_id',$user_id)->exists();
                                  if($supplier_id == 1)
                                  {
                                    $supplier_info = App\Models\SupplierUpgrade::where('user_id',$user_id)->first();
                                    $template_id = $supplier_info->temp_id;
                                    $template = App\Models\Template::where('id',$template_id)->exists();
                                    if ($template == 1) 
                                    {
                                      $template_info = App\Models\Template::where('id',$template_id)->first();
                                      $domain = $template_info->template_url;
                                    } 
                                    else 
                                    {
                                      $domain = '';
                                    } 
                                  }
                                  else
                                  {
                                    $domain = '';
                                  }
                              @endphp
                              <div class="form-group" style="display: none;">
                                <label>Domain URL</label>
                                <div>
                                    <input type="hidden" name="domain_url" value="{{ $domain }}"/>
                                </div>
                                @error('domain_url')
                                <div class="alert alert-danger">
                                        <strong>{{$mesage}}</strong>
                                </div>
                                @enderror
                            </div>
                             <!-- Append Table -->
                             <div class="col-lg-12">
                              <table> 
                                <tr> 
                                  <td><input type="button" value="Description Table" onclick="addRows()" class="btn btn-primary"/></td> 
                                  <td><input type="button" value="Delete Row" onclick="deleteRows()" class="btn btn-danger"/></td> 
                                </tr> 
                                @php
                                      $quantity = explode(",",$product->quantity);
                                      $quantity_count = count($quantity);
                                      $quprice = explode(",",$product->quprice);
                                      $quprice_count = count($quprice);
                                    @endphp
                                <table id="emptbl" style="width: 100%;">
                                  <tr>
                                    <th>Descrition One</th>
                                    <th>Description Two</th> 
                                  </tr> 
                                  @for ($i = 0; $i < $quprice_count; $i++)
                                    <tr> 
                                      <td id="col0"><input type="text" name="quantity[]" value="{{ $quantity[$i] }}" placeholder="Descrition One" class="form-control" /></td> 
                                      <td id="col1"><input type="text" name="quprice[]" value="{{ $quprice[$i] }}" placeholder="Descrition Two" class="form-control" /></td> 
                                      <td id="col2"> 
                                    </tr> 
                                  @endfor
                                   
                                </table> 
                              </table> 
                             </div>

                              <!-- End Append Table -->
                            <div class="form-group row mt-5">
                                <div class="col-lg-6">
                                    <label>Product Thumbnail Photo</label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image" id="profile-img" onchange="preview_image(event)"/>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <img src="{{ asset('uploads/product') }}/{{ $product->image }}" id="output_image" width="200px" style="padding-top: 5px;" />
                                    </div>
                                    @error('image')
                                    <div class="alert alert-danger">
                                            <strong>{{$mesage}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                {{--<div class="col-lg-6">
                                    <label>Product Multiple Photo </label>
                                    <div></div>
                                    <div>
                                        <input type="file" name="product_multiple_photo[]" class="form-control" multiple/>
                                    </div>
                                    @php
                                        $datas = App\Models\ProductDetails::where('product_id',$product->id)->get();
                                    @endphp
                                    <div class="row">
                                      @foreach ($datas as $data)
                                      <div class="col-md-2">
                                        <img src="{{ asset('uploads/product/product_details') }}/{{ $data->product_multiple_photo_name??'' }}" alt="" width="80px;">
                                      </div>   
                                      @endforeach
                                    </div>
                                    @error('product_multiple_photo')
                                    <div class="alert alert-danger">
                                            <strong>{{$mesage}}</strong>
                                    </div>
                                    @enderror
                                </div>--}}
                             </div>
                                
                                
                                    
                                <div class="form-group" style="text-align:end;">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                                </div>
                         </form>
                        </div>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
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

<script type=text/javascript>
  $('#business').change(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  var businessID = $(this).val();
  if(businessID){
    $.ajax({
      type:"GET",
      url:'/sup-get-country-list/'+businessID,
      // data : {"_token":"{{ csrf_token() }}"},
      dataType: "json",
      success:function(res){        
      if(res){
        $("#country").empty();
        $("#country").append('<option value="">No Select</option>');
        $.each(res,function(key,value){
          $("#country").append('<option value="'+value.id+'">'+value.category_name+'</option>');
        });
      
      }else{
        $("#country").empty();
      }
      }
    });
  }else{
    $("#country").empty();
    $("#state").empty();
  }   
  });
  $('#country').on('change',function(){
  var countryID = $(this).val();
  console.log(countryID);
  if(countryID){
    $.ajax({
      type:"GET",
      url:'/sup-get-state-list/'+countryID,
      success:function(res){        
      if(res){
        $("#state").empty();
        $("#state").append('<option value="">No Select</option>');
        $.each(res,function(key,value){
          $("#state").append('<option value="'+value.id+'">'+value.title+'</option>');
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
      url:'/sup-get-city-list/'+stateID,
      success:function(res){        
      if(res){
        $("#city").empty();
        $("#city").append('<option value="">No Select</option>');
        $.each(res,function(key,value){
          $("#city").append('<option value="'+value.id+'">'+value.title+'</option>');
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
<script type='text/javascript'>
function preview_photo(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_photo');
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
{{-- <script type=text/javascript>
  $('#country').change(function(){
  var countryID = $(this).val();
  if(countryID){
    $.ajax({
      type:"GET",
      url:'/get-state-list/'+countryID,
      data : {"_token":"{{ csrf_token() }}"},
      dataType: "json",
      success:function(res){        
      if(res){
        $("#state").empty();
        $("#state").append('<option value="">Select</option>');
        $.each(res,function(key,value){
          $("#state").append('<option value="'+value.id+'">'+value.title+'</option>');
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
        $("#state").append('<option value="">Select</option>');
        $.each(res,function(key,value){
          $("#city").append('<option value="'+value.id+'">'+value.title+'</option>');
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
</script> --}}
<script type=text/javascript>
  $('#category_id').change(function(){
  var countryID = $(this).val();
  if(countryID){
    $.ajax({
      type:"GET",
      url:'/get-state-list/'+countryID,
      data : {"_token":"{{ csrf_token() }}"},
      dataType: "json",
      success:function(res){        
      if(res){
        $("#subcategory_id").empty();
        $("#subcategory_id").append('<option>Select</option>');
        $.each(res,function(key,value){
          $("#subcategory_id").append('<option value="'+value.id+'">'+value.title+'</option>');
        });
      
      }else{
        $("#subcategory_id").empty();
      }
      }
    });
  }else{
    $("#subcategory_id").empty();
    $("#childcategory_id").empty();
  }   
  });
  $('#subcategory_id').on('change',function(){
  var stateID = $(this).val();
  console.log(stateID);
  if(stateID){
    $.ajax({
      type:"GET",
      url:'/get-city-list/'+stateID,
      success:function(res){        
      if(res){
        $("#childcategory_id").empty();
        $.each(res,function(key,value){
          $("#childcategory_id").append('<option value="'+value.id+'">'+value.title+'</option>');
        });
      
      }else{
        $("#childcategory_id").empty();
      }
      }
    });
  }else{
    $("#childcategory_id").empty();
  }
    
  });
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#category_id").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#subcategory_id").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#childcategory_id").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 250,
            });
        });

    </script>
     <script type="text/javascript">
        $(document).ready(function () {
            $('#summernotetwo').summernote({
                height: 250,
            });
        });

    </script>
    <script type="text/javascript">
      function addRows(){ 
        var table = document.getElementById('emptbl');
        var rowCount = table.rows.length;
        var cellCount = table.rows[0].cells.length; 
        var row = table.insertRow(rowCount);
        for(var i =0; i <= cellCount; i++){
          var cell = 'cell'+i;
          cell = row.insertCell(i);
          var copycel = document.getElementById('col'+i).innerHTML;
          cell.innerHTML=copycel;
          if(i == 3){ 
            var radioinput = document.getElementById('col3').getElementsByTagName('input'); 
            for(var j = 0; j <= radioinput.length; j++) { 
              if(radioinput[j].type == 'radio') { 
                var rownum = rowCount;
                radioinput[j].name = 'gender['+rownum+']';
              }
            }
          }
        }
      }
      function deleteRows(){
        var table = document.getElementById('emptbl');
        var rowCount = table.rows.length;
        if(rowCount > '2'){
          var row = table.deleteRow(rowCount-1);
          rowCount--;
        }
        else{
          alert('There should be atleast one row');
        }
      }
      </script>
    <script>
      function myFunction(val)
      {
        var x = val;
        var taka = x * 85.42;
        document.getElementById('price_taka').value = taka;
      }
    </script> 
    <script>
      function myFunctiontaka(val)
      {
        var x = val;
        var taka = x / 85.42;
        var dollar = taka.toFixed(2);
        document.getElementById('price_dollar').value = dollar;
      }
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
      function priceonedollar(val)
      {
        var x = val;
        var taka = x * 85.42;
        document.getElementById('price_taka').value = taka;
      }
    </script>
    <script>
      function priceonetaka(val)
      {
        var x = val;
        var taka = x / 85.42;
        var dollar = taka.toFixed(2);
        document.getElementById('product_price_one_dollar').value = dollar;
      }
    </script>   
    <script>
      function pricetwodollar(val)
      {
        var x = val;
        var taka = x * 85.42;
        document.getElementById('product_price_one').value = taka;
      }
    </script>
    <script>
      function pricetwotaka(val)
      {
        var x = val;
        var taka = x / 85.42;
        var dollar = taka.toFixed(2);
        document.getElementById('product_price_two_dollar').value = dollar;
      }
    </script> 
    <script>
      function pricethreedollar(val)
      {
        var x = val;
        var taka = x * 85.42;
        document.getElementById('product_price_two').value = taka;
      }
    </script>
    <script>
      function pricethreetaka(val)
      {
        var x = val;
        var taka = x / 85.42;
        var dollar = taka.toFixed(2);
        document.getElementById('product_price_three_dollar').value = dollar;
      }
    </script>
@endsection