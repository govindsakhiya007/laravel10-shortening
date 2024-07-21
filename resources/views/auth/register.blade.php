@extends('layouts.auth')
@section('title') {{ trans('label.user_register') }} @endsection
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
									<a href="#"><img src="{{ URL::asset('resources/assets/img/brand/favicon.png') }}" class="sign-favicon ht-40" alt="logo"></a>
								</div>
								<div class="main-signup-header">
									<h2 class="text-dark">Sign Up</h2>
									<h6 class="font-weight-normal mb-4">It's free to signup and only takes a minute.</h6>
									<form action="{{route('register')}}" method="POST" id="userform">
										@csrf
										<div class="form-group">
											<label for="name">{{ __('label.name') }}</label>
											<input class="form-control" placeholder="{{ __('placeholder.enter_name') }}" type="text" name="name" id="name" value="{{ old('name') }}">
											<div id="name_error" class="text-danger">@error('name'){{ $message }}@enderror</div>
										</div>
										<div class="form-group">
											<label for="email">{{ __('label.email') }}</label>
											<input class="form-control" placeholder="{{ __('placeholder.enter_email') }}" type="text" name="email" id="email" value="{{ old('email') }}">
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
										<div class="form-group">
											<label for="confirm_password">{{ __('label.confirm_password') }}</label>
											<div class="input-group">
												<input class="form-control" placeholder="{{ __('placeholder.confirm_password') }}" type="password" name="password_confirmation" id="confirm_password">
												<button class="btn btn-outline-primary" type="button" id="toggleConfirmPassword">
													<i class="bi bi-eye"></i>
												</button>
											</div>
											<div id="confirm_password_error" class="text-danger">@error('confirm_password'){{ $message }}@enderror</div>
										</div>
                                        <div class="form-group">
											<label for="name">{{ __('label.role') }}</label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="">{{ __('placeholder.role') }}</option>
                                                <option value="1">Organizer</option>
                                                <option value="2">Attendee</option>
                                            </select>
											<div id="role_error" class="text-danger">@error('role'){{ $message }}@enderror</div>
										</div>
										<button class="btn btn-primary btn-block" type="submit">{{ __('label.create_account') }}</button>
									</form>
				
									<div class="main-signup-footer mt-3 text-center">
										<p>Already have an account? <a href="{{route('login-form')}}">{{ __('label.sign_in') }}</a></p>
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
    var translations = {
        name: {
            required: <?php echo json_encode(trans('validations.login_form.name.required')) ; ?>,
            minlength: <?php echo json_encode(trans('validations.login_form.name.minlength')) ; ?>,
            maxlength: <?php echo json_encode(trans('validations.login_form.name.maxlength')) ; ?>
        },
		email: {
			required: <?php echo json_encode(trans('validations.login_form.email.required')); ?>,
			email: <?php echo json_encode(trans('validations.login_form.email.email')); ?>,
		},
		password: {
			required: <?php echo json_encode(trans('validations.login_form.password.required')) ; ?>,
			minlength: <?php echo json_encode(trans('validations.login_form.password.minlength')) ; ?>
		},
        confirm_password: {
			equalTo: <?php echo json_encode(trans('validations.login_form.confirm_password.equalTo')) ; ?>
		},
        role: {
			equalTo: <?php echo json_encode(trans('validations.login_form.role.required')) ; ?>
		}
	};

    $(document).ready(function() {
        $("#userform").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 8,
                    maxlength: 255
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                	equalTo: "#password"
            	},
                role: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: translations.name.required,
                    minlength: translations.name.minlength,
                    maxlength: translations.name.maxlength
                },
                email: {
                    required: translations.email.required,
                    email: translations.email.email
                },
                password: {
                    required: translations.password.required,
                    minlength: translations.password.minlength
                },
                confirm_password: {
                	equalTo: translations.confirm_password.equalTo
        		},
                role: {
                    required: "-- Please select a role --"
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

    // --
	// Toggle the eye in confirm password field
    $("#toggleConfirmPassword").click(function() {
        var passwordField = $("#confirm_password");
        var fieldType = passwordField.attr("type");

        if (fieldType === "password") {
            passwordField.attr("type", "text");
            $("#toggleConfirmPassword i").removeClass("bi-eye").addClass("bi-eye-slash");
        } else {
            passwordField.attr("type", "password");
            $("#toggleConfirmPassword i").removeClass("bi-eye-slash").addClass("bi-eye");
        }
    });
</script>
@endsection
