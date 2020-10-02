@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$register->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	<div class="box-body">
	@if($register->contact)
		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Tipo de Solicitud</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->contact->name }}</div>
		</div>
	@endif
		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Nombres</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->first_name }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Apellidos</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->last_name }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>DNI</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->dni }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Direcci&oacute;n</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->address }}</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Tel&eacute;fono</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->phone }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Email</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->email }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Comentario</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->comments }}</div>
		</div>

	@foreach ($fields as $rf)
		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>{{ $rf->field->name }}</label></div>
			<div class="col-sm-9 col-lg-10">{!! $rf->get_value() !!}</div>
		</div>
	@endforeach

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Fecha de Registro</label></div>
			<div class="col-sm-9 col-lg-10">{{ $register->created_at }}</div>
		</div>

	</div>
	<div class="box-footer">
		<a href="{{ route('register.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> regresar </a>
	</div>
</div>
@endsection
