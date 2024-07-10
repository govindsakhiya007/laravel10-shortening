	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<title>@yield('title')</title>
			<link rel="icon" href="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" type="image/x-icon"/>
				
			@include('include.auth-style')
			@yield('styles')
		</head>
		<body class="ltr error-page1 bg-primary">
			<!-- Loader -->
			<div id="global-loader">
				<img src="{{ URL::asset('resources/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
			</div>
			<!-- /Loader -->
			<div class="square-box">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
			@yield('content')

			<!-- Toasts -->
			<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
				<div id="auth-toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
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

			@include('include.auth-script')
			
			@yield('scripts')
		</body>
	</html>