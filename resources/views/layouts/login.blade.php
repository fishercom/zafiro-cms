<?php
$conf_sitename = \App\CmsConfig::where('alias', 'site_name')->first()->value;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" dir="ltr" lang="es"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" dir="ltr" lang="es">
<!--<![endif]-->
<head>
	<title>{{ $conf_sitename }} login</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="{{ asset('/assets/favicon.ico') }}" type="image/x-icon" />
	<link rel="icon" href="{{ asset('/assets/favicon.ico') }}" type="image/ico" />

	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- daterange picker -->
	<link rel="stylesheet" href="{{ asset('/assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/skins/skin-black.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/admin/css/custom.css') }}">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="{{ asset('/assets/plugins/iCheck/all.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="login"><b>{{ $conf_sitename }}</b> login</a>
        </div>

		@yield('content')

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Ups...</strong> hubieron algunos problemas con el envío.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

	</div>

    <!-- /.login-box -->
	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('/assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('/assets/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{ asset('/assets/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('/assets/dist/js/app.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('/assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' // optional
	    });
	  });
	</script>
</body>
</html>
