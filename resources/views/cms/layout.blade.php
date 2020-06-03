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
	<!-- cms template CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
	<!-- SummerNote CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
	<!-- Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <!-- My CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.scss') }}">

  @yield('extraCSS')

	<style media="screen">
		.main-content{
			min-height: calc(100vh - 87px) !important;
		}
	</style>

	<script>

		const BASE_URL = "{{ url('') }}/";

	</script>

  <title>Sneakr Admin Panel</title>
</head>
<body>


		<header>
			<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
			  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('cms/dashboard') }}">Sneakr Admin Panel</a>
			  <ul class="nav px-2">
					@if ($unread_messages > 0)
					<li class="nav-item text-nowrap">
						<a href="{{ url('cms/messages') }}" class="nav-link text-white" style="line-height:1.2">
							<span class="badge badge-pill badge-danger py-1">{{ $unread_messages }} new messages</span>
						</a>
			    </li>
					@endif
					<li class="nav-item text-nowrap">
			      <a target="_blank" class="nav-link text-white" href="{{ url('') }}">Front Site</a>
			    </li>
			    <li class="nav-item text-nowrap">
			      <a class="nav-link text-white" href="{{ url('logout') }}">Logout</a>
			    </li>
			  </ul>
			</nav>
		</header>

		<div class="container-fluid">
		  <div class="row">
		    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
		      <div class="sidebar-sticky">
		        <ul class="nav flex-column">

							@if (Request::url() == url('cms/dashboard'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/dashboard') }}">
										Dashboard
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/dashboard') }}">
										Dashboard
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/menu'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/menu') }}">
										Menu
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/menu') }}">
										Menu
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/content'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/content') }}">
										Content
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/content') }}">
										Content
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/categories'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/categories') }}">
										Categories
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/categories') }}">
										Categories
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/products'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/products') }}">
										Products
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/products') }}">
										Products
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/orders'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/orders') }}">
										Orders
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/orders') }}">
										Orders
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/users'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/users') }}">
										Users
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/users') }}">
										Users
									</a>
								</li>
							@endif

							@if (Request::url() == url('cms/messages'))
								<li class="nav-item bg-dark">
									<a class="nav-link text-light" href="{{ url('cms/messages') }}">
										Messages @if ($unread_messages > 0) <span class="badge badge-danger p-1 ml-1">{{ $unread_messages }}</span> @endif
									</a>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{ url('cms/messages') }}">
										Messages @if ($unread_messages > 0) <span class="badge badge-danger p-1 ml-1">{{ $unread_messages }}</span> @endif
									</a>
								</li>
							@endif

		        </ul>
					</div>
				</nav>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
		      @yield('content')
		    </main>

			</div>
		</div>


		<!--Footer Area Start-->
		<footer>
		    <div class="footer-container">
		        <!--Footer Bottom Area Start-->
		        <div class="footer-bottom-area pt-30 pb-20">
		            <div class="container">
		                <div class="row">
		                    <div class="col-12 text-center">
		                        <!--Footer Copyright Start-->
		                        <div class="footer-copyright pt-3">
		                            <p>Copyright &copy; <a href="{{ url('') }}">Sneakr.</a> All Rights Reserved</p>
		                        </div>
		                        <!--Footer Copyright End-->
		                    </div>
		                </div>
		            </div>
		        </div>
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
	<!-- Toastr JS -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<!-- SummerNote JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
	<!-- chartJS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<!-- Select2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
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
