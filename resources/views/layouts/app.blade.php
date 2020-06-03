<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

  <!--All Css Here-->

	<!-- Elegant Icon Font CSS-->
  <link rel="stylesheet" href="{{ asset('lib/indecor/css/elegant_font.css') }}">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
	<!-- lib Font Awesome CSS-->
	<link rel="stylesheet" href="{{ asset('lib/indecor/css/font-awesome.min.css') }}">
  <!-- Ionicons CSS-->
  <link rel="stylesheet" href="{{ asset('lib/indecor/css/ionicons.min.css') }}">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="{{ asset('lib/indecor/css/bootstrap.min.css') }}">
	<!-- Plugins CSS-->
	<link rel="stylesheet" href="{{ asset('lib/indecor/css/plugins.css') }}">
	<!-- Style CSS -->
	<link rel="stylesheet" href="{{ asset('lib/indecor/style.css') }}">
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="{{ asset('lib/indecor/css/responsive.css') }}">
	<!-- Modernizr Js -->
	<script src="{{ asset('lib/indecor/js/vendor/modernizr-2.8.3.min.js') }}"></script>
	<!-- Toastr CSS-->
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
	<!-- Jquery UI CSS-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.scss') }}">

  @yield('extraCSS')

	<style>
		.sidebar-trigger-search{
			cursor: pointer;
		}
	</style>

	<script>

		const BASE_URL = "{{ url('') }}/";
		const ASSET_URL = "{{ asset('') }}";

	</script>

  <title>Sneakr {{ !empty($page_title) ? $page_title : '' }}</title>
</head>
<body>
	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<div class="wrapper wrapper-box">
		<!--Header Area Start-->
		<header>
		    <!--Default Header Area Start-->
		    <div class="default-header-area header-sticky">
		        <div class="container">
		            <div class="row align-items-center">
		                <div class="col-lg-3 col-md-4 col-12">
		                    <!--Logo Area Start-->
		                    <div class="logo-area mb-lg-3 p-0">
		                        <a href="{{ url('') }}"><img width="150" src="{{ asset('imgs/logo.png') }}" alt="site logo"></a>
		                    </div>
		                    <!--Logo Area End-->
		                </div>
		                <div class="col-lg-6 col-md-4 d-none d-lg-block col-12">
                            <!--Header Menu Area Start-->
                            <div class="header-menu-area text-center">
                                <nav>
                                    <ul class="main-menu">
																			<li><a href="{{ url('') }}">Home</a></li>
																			@if (!empty(App\Menu::all()->toArray()))
																				@foreach (App\Menu::all()->toArray() as $menu)
																					<li><a href="{{ url($menu['murl']) }}">{{ $menu['link'] }}</a></li>
																				@endforeach
																			@endif
                                    </ul>
                                </nav>
                            </div>
                            <!--Header Menu Area End-->
                        </div>
                        <div class="col-lg-3 col-md-5 col-12">
                            <!--Header Search And Mini Cart Area Start-->
                            <div class="header-search-cart-area">
                                <ul class="d-flex">
                                    <li><a class="sidebar-trigger-search" role="button" tabindex="0"><span class="icon_search"></span></a></li>
																		@if ( ! Session::has('user_id') )
                                    <li class="currency-menu"><a href="{{ url('login') }}"><i class="far fa-user"></i></a>
																		@else
																		<li class="currency-menu"><a href="{{ url('account') }}"><i class="far fa-user"></i></a>
																		@endif
                                        <!--Crunccy dropdown-->
                                        <ul class="currency-dropdown">
                                          <!--Account Currency Start-->
																					@if ( ! Session::has('user_id') )
                                          <li><a href="{{ url('signup') }}">Hello, Guest !</a>
																							<ul>
	                                                <li><a href="{{ url('login') }}"><i class="fas fa-sign-in-alt mr-2"></i> Login</a></li>
	                                                <li><a href="{{ url('signup') }}"><i class="fas fa-user-plus mr-2"></i> Sign up</a></li>
	                                            </ul>
																					</li>
																						@else
																							<li><a href="{{ url('account') }}">Hello, {{ Session::get('user_name') }} !</a>
																								<ul>
																									<li><a href="{{ url('account') }}"><i class="fas fa-user-circle mr-2"></i> My Account</a></li>
																									@if (Session::has('is_admin'))
																										<li><a href="{{ url('cms/dashboard') }}"><i class="fas fa-key mr-2"></i> Admin Panel</a></li>
																									@endif
																									<li><a href="{{ url('logout') }}"><i class="fas fa-sign-out-alt mr-2"></i> logout</a></li>
																								</ul>
																							</li>
																						@endif
                                          <!--Account Currency End-->
                                        </ul>
                                        <!--Crunccy dropdown-->
                                    </li>
                                    <li class="mini-cart"><a href="{{ url('cart') }}"><span class="icon_cart_alt"></span>
																		@if (Cart::getTotalQuantity())
																			<span class="cart-quantity">{{ Cart::getTotalQuantity() }}</span>
																		@endif
																		</a>
                                    </li>
                                </ul>
                            </div>
                            <!--Header Search And Mini Cart Area End-->
                        </div>
		            </div>
		            <div class="row">
                        <div class="col-12">
                            <!--Mobile Menu Area Start-->
                            <div class="mobile-menu d-lg-none"></div>
                            <!--Mobile Menu Area End-->
                        </div>
                    </div>
		        </div>
		    </div>
		    <!--Default Header Area End-->
		</header>
		<!--Header Area Start-->

		<!-- main-search start -->
        <div class="main-search-active">
            <div class="sidebar-search-icon">
                <button class="search-close"><span class="ion-android-close"></span></button>
            </div>
            <div class="sidebar-search-input">
                <form action="{{ url('shop/all') }}" method="GET" novalidate autocomplete="off" id="search_form">
                    <div class="form-search">
                        <input id="search" name="search" class="input-text" value="" placeholder="Search Entire Store" type="search">
                        <button type="submit"><i class="ion-android-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- main-search End -->

    <main>
      @yield('content')
    </main>


		<!--Footer Area Start-->
		<footer>
		    <div class="footer-container">

		        <!--Footer Bottom Area Start-->
		        <div class="footer-bottom-area pt-30 pb-20">
		            <div class="container">
		                <div class="row">
		                    <div class="col-lg-6 col-md-12 col-12 mx-auto">
		                        <div class="footer-copyright text-center">
		                            <p>Copyright &copy; <a href="{{ url('') }}">Sneakr.</a> All Rights Reserved</p>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <!--Footer Bottom Area End-->
		    </div>
		</footer>
		<!--Footer Area End-->
	</div>





  <!--All Js Here-->

	<!--Jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--Popper-->
	<script src="{{ asset('lib/indecor/js/popper.min.js') }}"></script>
	<!--Bootstrap-->
	<script src="{{ asset('lib/indecor/js/bootstrap.min.js') }}"></script>
	<!--Ajax Mail-->
	<script src="{{ asset('lib/indecor/js/ajax-mail.js') }}"></script>
	<!--Plugins-->
	<script src="{{ asset('lib/indecor/js/plugins.js') }}"></script>
	<!--Main Js-->
	<script src="{{ asset('lib/indecor/js/main.js') }}"></script>
	<!-- Toastr JS -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<!-- MatchHeight JS -->
	<script src="{{ asset('js/jquery.matchHeight.js') }}"></script>
	<!--Jquery UI -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- my JS -->
  <script src="{{ asset('js/main.js') }}" charset="utf-8"></script>

	@if( Session::has('successM') )
	<script>
		toastr.options.positionClass = 'toast-bottom-right';
		toastr.success("{{ Session::get('successM') }}");
	</script>
	@endif

  @yield('extraJS')

</body>
</html>
