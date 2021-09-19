@extends('layouts.frontend')
@section('title')
    
@endsection
@section('css')
    
@endsection
@section('content')
<section id="categories-section" class="py-4">
    <div class="container-fluid ">
        <div class="categories-section-bg">

            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-12">
                            <h3>Related Categories</h3>
                        </div>
                    </div>
                    <div class="row px-3">
                        <div class="col-12">
                            <div class="category-sidebar-item">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 (20)</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 (30)</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 (15)</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 (13)</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 </a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 (40)</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-1 (12)</a>
                                        
                                        <ul class="pl-4">
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                            <li>
                                                <a href="#"> Child Category</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-2 (12)</a>
                                        <i class="fas fa-chevron-down"></i>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-angle-double-right"></i> Sub Category-16</a>
                                        <i class="fas fa-chevron-down"></i>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filter-product pl-4">
                        <div class="row">
                            <div class="col-12">
                                <label for="minqty">Min. Order</label>
                                <div class="input-box">
                                    <input class="w-50" type="text" id="minqty" value="" placeholder="Enter min qty">
                                    <button type="submit">Ok</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="minqty">Price</label>
                                <div class="input-box d-flex">
                                    <input class="w-25" type="text" id="minprice" value="" placeholder="Min">-
                                    <input class="w-25" type="text" id="maxprice" value="" placeholder="Max">
                                    <button type="submit">Ok</button>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="input-box d-flex">
                                    <input type="checkbox" id="lowtohigh"> <span class="mt-1 pl-2"> Low to High</span>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-box d-flex">
                                    <input type="checkbox" id="hightolow"> <span class="mt-1 pl-2"> High To Low</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="minqty">Supplier Country/Region</label>
                                <div class="input-box d-flex">
                                    <input class="w-50" type="text" id="country" value="" placeholder="Search Country">
                                    <button type="submit">Ok</button>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="input-box d-flex">
                                    <input type="checkbox" id="countryName"> <span><img class="ml-2" width="25px" height="15px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/255px-Flag_of_the_People%27s_Republic_of_China.svg.png" alt=""></span><span class="pl-2"> China</span>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-box d-flex">
                                    <input type="checkbox" id="countryName"> <span><img class="ml-2" width="25px" height="15px" src="https://cdn.britannica.com/41/4041-004-D051B135/Flag-Vietnam.jpg" alt=""></span><span class="pl-2"> Vietnam</span>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="input-box d-flex">
                                    <input type="checkbox" id="countryName"> <span><img class="ml-2" width="25px" height="15px" src="https://cdn.britannica.com/67/6267-004-10A21DF0/Flag-Bangladesh.jpg" alt=""></span><span class="pl-2"> Bangladesh</span>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-box d-flex">
                                    <input type="checkbox" id="countryName"> <span><img class="ml-2" width="25px" height="15px" src="https://upload.wikimedia.org/wikipedia/en/thumb/4/41/Flag_of_India.svg/1200px-Flag_of_India.svg.png" alt=""></span><span class="pl-2"> India</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                <section id="product-list">
                    <div class="container-fluid">
                        <div class="product-list-bg">
                            <div class="row">
                                <div class="col-12">
                                    <h3>{{ $child_name->title??'' }}</h3>
                                </div>
                            </div>
                            <div class="row px-3">
                                @foreach ($child_products as $product)
                                <div class="col-sm-6 col-md-2 col-lg-3 mb-4">
                                    <div class="product-list-card">
                                        <div class="product-list-head">
                                            <div class="product-list-img">
                                                <a href="{{ route('product_details',['slug' => $product->slug]) }}"><img class="img-fluid" src="{{ asset('uploads/product') }}/{{ $product->image??'photo.jpg' }}" alt=""></a>
                                            </div>
                                            <div class="product-list-viewdetails">
                                                <a href="{{ route('product_details',['slug' => $product->slug]) }}">View Details</a>
                                            </div>
                                        </div> 
                                        <div class="product-list-details">
                                            <a href="{{ route('product_details',['slug' => $product->slug]) }}"><h6>{{ $product->product_name??'' }}</h6></a>
                                            <a href="{{ route('product_details',['slug' => $product->slug]) }}"></a><p>Price : ${{ $product->price_dollar??'' }}</p></a>
                                            <div class="product-list-ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach 
                            </div>
                        </div>
                    </div>
                </section>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Individual Categories Section End -->

@endsection
@section('js')
    
@endsection