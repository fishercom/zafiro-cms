@extends('layouts.login')

@section('content')
<div class="login-box-body">
	<p class="login-box-msg">Iniciar Sesión</p>

	<form role="form" method="POST" action="{{ url('/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group has-feedback">
			<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Usuario" autocomplete="off">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<input type="password" class="form-control" name="password" placeholder="Clave" autocomplete="off">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">
			  <div class="checkbox icheck">
				<label>
				  <input type="checkbox" name="remember"> Recuérdame
				</label>
			  </div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
			  <button type="submit" id="btnSubmit" name="btSubmit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
			</div>
		<!-- /.col -->
		</div>
	</form>
	<!-- /.social-auth-links -->
	<a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidó su clave?</a>
</div>
@endsection
