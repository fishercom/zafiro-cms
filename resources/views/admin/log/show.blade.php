@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar Perfil: {{$log->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	<div class="box-body">

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Fecha</label></div>
			<div class="col-sm-9 col-lg-10">{{ $log->created_at }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Usuario</label></div>
			<div class="col-sm-9 col-lg-10">{{ $log->user->name }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Email</label></div>
			<div class="col-sm-9 col-lg-10">{{ $log->user->email }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Módulo</label></div>
			<div class="col-sm-9 col-lg-10">{{ $log->event->module->name }}</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-3 col-lg-2"><label>Comentario</label></div>
			<div class="col-sm-9 col-lg-10">{{ $log->comment }}</div>
		</div>

	</div>
	<div class="box-footer">
		<a href="{{ route('log.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
	</div>
</div>
@endsection
