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
	<title>{{ $conf_sitename }} admin</title>
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
	<link rel="stylesheet" href="{{ asset('/assets/plugins/datepicker/datepicker3.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/skins/skin-blue.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/admin/css/custom.css') }}">

	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="{{ asset('/assets/plugins/iCheck/all.css') }}">
	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('/assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('/assets/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{ asset('/assets/plugins/iCheck/icheck.min.js') }}"></script>

	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="{{ asset('/assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('/assets/dist/js/app.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('/assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	//$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="{{ asset('/assets/admin/js/navigate.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/assets/admin/js/custom.js') }}" type="text/javascript"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">{{ $conf_sitename }}</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
								<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
                  				</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

</body>
</html>
