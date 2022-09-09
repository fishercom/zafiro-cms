<?php
$contact=\App\Models\CmsParameter::find($register->contact_id);
?>
<div style="padding: 30px; font-family: arial; line-height: 25px; background-color: #C50A37; color: #fff; border-radius: 10px">
	<img src="{{ url('/images/logo.svg') }}" />
	<h1>Solicitud de Contacto</h1>
@if($contact)
	<div>
		<div style="display: inline-block; width: 120px">
			Clasificación:
		</div>
		<div style="display: inline-block;">
			{{ $contact->name }}
		</div>
	</div>
@endif
	<div>
		<div style="display: inline-block; width: 120px">
			Nombre:
		</div>
		<div style="display: inline-block;">
			{{ $register->name }}
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
			Mensaje:
		</div>
		<div style="display: inline-block;">
			{{ $register->message }}
		</div>
	</div>
</div>