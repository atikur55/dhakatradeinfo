<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.exzoom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <!-- Navbar Section Start Here -->
    <section id="topnav" class="top-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-topnav">
                        <h5>You may sell your products free!!</h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-topnav">
                        <a href="#" title="Update News"><i class="fas fa-newspaper"></i></a>
                        <a href="#" title="Need Help"><i class="fas fa-question-circle"></i></a>
                        <a href="{{ route('track') }}" title="Messages"><i class="fas fa-comments"></i></i></a>
                        <a href="{{ route('custom.login') }}" title="Login"><i class="fas fa-user"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="br"></div> -->
    </section>


    <section id="botomnav" class="">
        <nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="logo">
                            <a href="{{ url('/') }}">DHAKA TRADE INFO</a>
                        </div>
                        <label for="btn" class="icon">
                          <span class="fa fa-bars"></span>
                        </label>
                        <input type="checkbox" id="btn">
                        <ul>
                          <li><a href="{{ url('/') }}">Home</a></li>
                          @php
                              $businesses = App\Models\BusinessType::orderBy('business_name')->get();
                          @endphp
                          <li>
                            <label for="btn-1" class="show">Business +</label>
                            <a href="#">Business</a>
                            <input type="checkbox" id="btn-1">
                            <ul>
                                @foreach ($businesses as $data)
                                <li><a href="#">{{ $data->business_name??'' }}</a></li>
                                @endforeach
                            </ul>
                          </li>
                          @php
                            $categories = App\Models\Category::where('status',0)->orderBy('category_name')->get();
                          @endphp
                          <li>
                            <label for="btn-2" class="show">Categories +</label>
                            <a href="#">Categories</a>
                            <input type="checkbox" id="btn-2">
                            <ul>
                                @foreach ($categories as $category)
                                    {{-- <li><a href="#">{{ $category->category_name??'' }}</a></li> --}}
                                
                                <li>
                                    <label for="btn-3" class="show">{{ $category->category_name??'' }} +</label>
                                    <a href="#">{{ $category->category_name??'' }}
                                    {{-- <span class="fa fa-plus"></span> --}}
                                    </a>
                                    <input type="checkbox" id="btn-3">
                                    @php
                                        $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('title')->get();
                                    @endphp
                                    <ul>
                                        @foreach ($subcategories as $subcategory)
                                        {{-- <li><a href="#">Eastman CNC</a></li> --}}
                                        {{-- <li><a href="#">Bullmer</a></li>
                                        <li><a href="#">Computerized</a></li> --}}
                                        <li>
                                            <label for="btn-4" class="show">{{ $subcategory->title??'' }} +</label>
                                            <a href="#">{{ $subcategory->title??'' }}
                                            {{-- <span class="fa fa-plus"></span> --}}
                                            </a>
                                            @php
                                                $childcategories = App\Models\ChildCategory::where('subcategory_id',$subcategory->id)->orderBy('title')->get();
                                            @endphp
                                            <input type="checkbox" id="btn-4">
                                            <ul>
                                                @foreach ($childcategories as $childcategory)
                                                    <li><a href="#">{{ $childcategory->title??'' }}</a></li>
                                                @endforeach
                                            
                                            {{-- <li><a href="#">Test2</a></li> --}}
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                          </li>
                          <li><a href="{{ route('supplier.register') }}">Be a Seller</a></li>
                          <li><a href="#">Blog</a></li>
                          <li><a href="#">About</a></li>
                          <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <!-- <section id="bottom-stiky-nav">
        <nav class="navbar fixed-bottom navbar-light d-lg-none">
            <a href="#"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fab fa-facebook-messenger"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fas fa-phone" aria-hidden="true"></i></a>
        </nav>
    </section> -->
<!-- Navbar Section End -->
@yield('content')

  
<!-- Newslatter Section Start -->
    <section id="newsletter" class="mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-center text-md-left">
                    <h3 class="text-white">Get Updates of Upcoming Offers</h3>
                </div>
                <div class="col-md-6 mt-md-4">
                    <form action="#">
                        <input type="text" name="email" placeholder="Enter Your Email">
                        <button type="submit" value="Submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!-- Newslatter Section End -->

<!-- Footer Section Start -->
<section class="footer-bg-img" style="background-image: url(assets/img/footer-bg.png);">
    <div class="footer-bg-overlay pt-5">
        <section id="footer-top" class="pb-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo">
                            <a href="{{ '/' }}"><h1>DHAKA<span>TRADE</span>INFO</h1></a>
                        </div>
                        <div class="description">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta animi obcaecati neque velit, deleniti earum aperiam culpa minus possimus delectus!</p>
                        </div>
                        <div class="address">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>123 Sonargaon Janapath, Uttara, Dhaka</span>
                        </div>
                        <div class="email-address">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>info@example.com</span>
                        </div>
                        <div class="phone-number">
                            <i class="fas fa-phone mr-2"></i>
                            <span>017634822**</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-6">
                                <h5>Useful links</h5>
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Location</a></li>
                                    <li><a href="#">Complain</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <h5>My Account</h5>
                                <ul>
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Terms</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="#">Privacy</a></li>
                                    <li><a href="#">Order Tracking</a></li>
                                    <li><a href="#">Claim</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Instagram</h5>
                        <div class="row">
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p1.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p2.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p3.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p4.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p5.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p6.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p7.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p8.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p9.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p10.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p11.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-3 my-2">
                                <img src="assets/img/product/p12.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="br mt-5"></div>
            </div>
        </section>
        <!-- <section id="footer-mid" class="">
            <div class="container-fluid">
                <div class="row pt-3 pb-4">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="icon">
                                    <i class="fas fa-car"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <h5>Ontime Delivery</h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <h5>30 Days Order Cancelation Policy</h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-4">
                                <div class="icon">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <h5>27/4 Online Support</h5>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="br"></div>
            </div>
        </section> -->

            <section id="footer-buttom" class="py-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="d-md-none pb-2">Social Links:</h5>
                            <div class="social">
                                <i class="fab fa-facebook-square"></i>
                                <i class="fab fa-twitter-square"></i>
                                <i class="fab fa-linkedin"></i>
                                <i class="fab fa-google-plus-square"></i>
                                <i class="fab fa-youtube-square"></i>
                            </div>
                        </div>
                        <div class="d-none d-md-flex col-md-4">
                            <p>&copy 2021 All Rights Reserved by Uttara Infotech</p>
                        </div>
                        <div class="mt-3 mt-md-0 col-md-4">
                            <h5 class="d-md-none py-2">Payment Via:</h5>
                            <div class="payment">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-discover"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-paypal"></i>
                                <i class="fab fa-cc-amex"></i>
                            </div>
                        </div>
                        <div class="d-md-none mt-3 col-md-4">
                            <p>&copy 2021 All Rights Reserved by Eshopbd.com</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
<!-- Footer Section End -->

    <!-- JS here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <script src="{{ asset('assets/js/progress.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sliderScript.js') }}"></script>
    <script src="{{ asset('assets/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/js/uikit-icons.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/particles/particles.js') }}"></script>
    <script src="{{ asset('assets/js/particles/app.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="{{ asset('assets/js/jquery.exzoom.js') }}"></script>
	<script type="text/javascript">
		$(function(){

		  $("#exzoom").exzoom({
			// thumbnail nav options
			"navWidth": 60,
			"navHeight": 60,
			"navItemNum": 5,
			"navItemMargin": 7,
			"navBorder": 1,

			// autoplay
			"autoPlay": false,

			// autoplay interval in milliseconds
			"autoPlayTimeout": 2000
		  });

		});
    </script>
    @yield('js')
</body>

</html>
