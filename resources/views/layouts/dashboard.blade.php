<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Include the CSRF token meta tag with Blade templating -->

		<title>@yield('title')</title>
		<!-- Favicon -->
		<link rel="icon" href="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" type="image/x-icon"/>
		<!-- BEGIN CSS FILES -->
			@include('include.style')
			@yield('styles')
		<!-- END CSS FILES -->
	</head>
	<body class="ltr main-body app sidebar-mini">
		<!-- Loader -->
			<div id="global-loader">
				<img src="{{ URL::asset('resources/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
			</div>
		<!-- /Loader -->
		<!-- Page -->
		<div class="page">

			<div>
				<!-- BEGIN HEADER -->
					@include('include.header')
				<!-- END HEADER -->

				<!-- BEGIN SIDEBAR -->
					@include('include.sidebar')
				<!-- END SIDEBAR -->
			</div>

			<!-- main-content -->
				<div class="main-content app-content">
					<div class="main-container container-fluid">
						@yield('content') 
					</div>
				</div>
			<!-- /main-content -->

			<!-- BEGIN FOOTER -->
			 @include('include.footer')
			<!-- END FOOTER -->
		</div>

		<!-- Toasts -->
		<div class="position-fixed top-0 end-0 p-3" style="z-index: 2000">
			<div id="toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
				@if(session('success'))
					<div class="toast-body text-white p-3 bg-primary">
						{{ session('success') }}
					</div>
				@endif
				@if(session('error'))
					<div class="toast-body text-white p-3 bg-secondary">
						{{ session('error') }}
					</div>
				@endif
			</div>
		</div>

		<!-- URLS toasts -->
		<div class="position-fixed top-0 end-0 p-3" style="z-index: 2000">
			<div id="toast-urls" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
				<div id="toast-message" class="toast-body text-white p-3"></div>
			</div>
		</div>

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>
		<!-- BEGIN JAVASCRIPTS -->
			@include('include.script')
			@yield('scripts')
		<!-- END JAVASCRIPTS -->    
	</body>
</html>