<!-- JQuery min js -->
<script src="{{ URL::asset('resources/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ URL::asset('resources/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ URL::asset('resources/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- JQuery Validation min js -->
<script src="{{ URL::asset('resources/assets/plugins/jquery/jquery.validate.min.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('resources/assets/plugins/raphael/raphael.min.js') }}"></script>
<!--Bootstrap-datepicker js-->
<script src="{{ URL::asset('resources/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Eva-icons js -->
<script src="{{ URL::asset('resources/assets/js/eva-icons.min.js') }}"></script>
<!-- right-sidebar js -->
<script src="{{ URL::asset('resources/assets/plugins/sidebar/sidebar.js') }}"></script>
<!-- <script src="{{ URL::asset('resources/assets/plugins/sidebar/sidebar-custom.js') }}"></script> -->
<!-- Sidebar js -->
<script src="{{ URL::asset('resources/assets/plugins/side-menu/sidemenu.js') }}"></script>
<!-- Sticky js -->
<script src="{{ URL::asset('resources/assets/js/sticky.js') }}"></script>
<!--Internal  index js -->
<script src="{{ URL::asset('resources/assets/js/index.js') }}"></script>
<!-- Chart-circle js -->
<script src="{{ URL::asset('resources/assets/js/circle-progress.min.js') }}"></script>
<!-- Internal Data tables -->
<script src="{{ URL::asset('resources/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('resources/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ URL::asset('resources/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('resources/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
<!--Internal  Sweet-Alert js-->
<script src="{{ URL::asset('resources/assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('resources/assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>
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
        var toast = new bootstrap.Toast(document.getElementById('toast'));
        toast.show();
        setTimeout(function(){
            toast.hide();
        }, 5000);
    @endif
</script>