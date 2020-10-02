@if (count($errors) > 0 || Session::has('error'))
	<div class="alert alert-danger fade show" role="alert">
		@if(Session::has('error'))
			<span>{{ Session::get('error') }}</span>
		@else
			<strong>{{ transl('¡Ups!') }}</strong> {{ transl('Hay algunos problemas con los datos enviados.') }}<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>- {{ $error }}</li>
				@endforeach
			</ul>
		@endif
	</div>
@endif
