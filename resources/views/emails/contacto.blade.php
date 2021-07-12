<?php
$parameter=\App\Models\CmsParameter::find($register->contact_id);
?>
<figure>
	<img src="{{ url('/images/logo_sslp.png') }}" />
</figure>
<div style="font-family: arial">
	<h1>Solicitud de Contacto</h1>

	<div>
		<div style="display: inline-block; width: 120px">
			Clasificación:
		</div>
		<div style="display: inline-block;">
			{{ $parameter->name }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			Nombres:
		</div>
		<div style="display: inline-block;">
			{{ $register->first_name }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			Apellidos:
		</div>
		<div style="display: inline-block;">
			{{ $register->last_name }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			DNI:
		</div>
		<div style="display: inline-block;">
			{{ $register->dni }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			Dirección:
		</div>
		<div style="display: inline-block;">
			{{ $register->address }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			E-mail:
		</div>
		<div style="display: inline-block;">
			{{ $register->email }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			Teléfono:
		</div>
		<div style="display: inline-block;">
			{{ $register->phone }}
		</div>
	</div>
	<div>
		<div style="display: inline-block; width: 120px">
			Comentario:
		</div>
		<div style="display: inline-block;">
			{{ $register->comment }}
		</div>
	</div>
</div>