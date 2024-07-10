@extends('layouts.auth')

@section('title') {{ trans('label.user_login') }} @endsection

@section('content')
<div class="page" >
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-xs-10 card-sigin-main py-4 justify-content-center mx-auto">
                    <div class="card-sigin ">
						<div class="main-card-signin d-md-flex">
							<div class="wd-100p">
								<div class="d-flex mb-4">
									<a href="#">
										<img src="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" class="sign-favicon ht-40" alt="logo">
									</a>
								</div>
								<div class="main-signup-header">
									<h2 class="text-dark">{{ __('label.front_login') }}</h2>
									<h6 class="font-weight-normal mb-4">{{ __('label.sign_in_msg') }}</h6>
									<form action="{{route('login')}}" method="POST" id="loginForm">
										@csrf
										<div class="form-group">
											<label for="email">{{ __('label.email') }}</label>
											<input class="form-control" placeholder="{{ __('placeholder.enter_email') }}" type="email" name="email" id="email" value="{{ old('email') }}">
											<div id="email_error" class="text-danger">@error('email'){{ $message }}@enderror</div>
										</div>
										<div class="form-group">
											<label for="password">{{ __('label.password') }}</label>
											<div class="input-group">
												<input class="form-control" placeholder="{{ __('placeholder.enter_password') }}" type="password" name="password" id="password">
												<button class="btn btn-outline-primary" type="button" id="togglePassword">
													<i class="bi bi-eye"></i>
												</button>
											</div>
											<div id="password_error" class="text-danger">@error('password'){{ $message }}@enderror</div>
										</div>
										<button class="btn btn-primary btn-block" type="submit">{{ __('label.sign_in') }}</button>
									</form>
									<div class="main-signin-footer text-center mt-3">
										<p>{{ __('label.dont_have_account') }} <a href="{{ route('register-form') }}">{{ __('label.createaccount') }}</a></p>
									</div>
								</div>
							</div>
						</div>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			// --
			// Get translation messages
			var translations = {
				email: {
					required: <?php echo json_encode(trans('validations.login_form.email.required')); ?>,
					email: <?php echo json_encode(trans('validations.login_form.email.email')); ?>,
				},
				password: {
					required: <?php echo json_encode(trans('validations.login_form.password.required')) ; ?>,
					minlength: <?php echo json_encode(trans('validations.login_form.password.minlength')) ; ?>
				}
			};
			
			// --
			// Validate login form
			$("#loginForm").validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					password: {
						required: true,
						minlength: 8
					}
				},
				messages: {
					email: {
						required: translations.email.required,
						email: translations.email.email
					},
					password: {
						required: translations.password.required,
						minlength: translations.password.minlength
					}
				},
				errorPlacement: function(error, element) {
					var name = element.attr('name');
					error.appendTo($('#' + name + '_error'));
				},
				submitHandler: function(form) {
					form.submit();
				}
			});
		});

		// --
		// Toggle the eye in password field
		$("#togglePassword").click(function() {
			var passwordField = $("#password");
			var fieldType = passwordField.attr("type");

			if (fieldType === "password") {
				passwordField.attr("type", "text");
				$("#togglePassword i").removeClass("bi-eye").addClass("bi-eye-slash");
			} else {
				passwordField.attr("type", "password");
				$("#togglePassword i").removeClass("bi-eye-slash").addClass("bi-eye");
			}
		});
	</script>
@endsection
