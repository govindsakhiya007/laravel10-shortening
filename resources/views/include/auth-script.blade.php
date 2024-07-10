<!-- JQuery min js -->
<script src="{{ URL::asset('resources/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ URL::asset('resources/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ URL::asset('resources/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- JQuery Validation min js -->
<script src="{{ URL::asset('resources/assets/plugins/jquery/jquery.validate.min.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('resources/assets/plugins/moment/moment.js') }}"></script>
<!-- eva-icons js -->
<script src="{{ URL::asset('resources/assets/js/eva-icons.min.js') }}"></script>
<!-- generate-otp js -->
<script src="{{ URL::asset('resources/assets/js/generate-otp.js') }}"></script>
<!--Internal  Perfect-scrollbar js -->
<script src="{{ URL::asset('resources/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<!-- Theme Color js -->
<script src="{{ URL::asset('resources/assets/js/themecolor.js') }}"></script>
<!-- custom js -->
<script src="{{ URL::asset('resources/assets/js/custom.js') }}"></script>
<!-- Header Token -->
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

<!-- Toast message -->
<script type="text/javascript">
    @if(session('success') || session('error'))
        var toast = new bootstrap.Toast(document.getElementById('auth-toast'));

        toast.show();
        setTimeout(function(){
            toast.hide();
        }, 5000);
    @endif
</script>