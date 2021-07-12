<?php
//use Jenssegers\Date\Date;
use App\Models\CmsRegister;

$created=Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s'); //Date::parse($user->created_at)->format('d/m/Y H:i:s');
$updated=Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s'); //Date::parse($user->updated_at)->format('d/m/Y H:i:s');

//$registers = $user->registers;
?>
@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Datos de {{ $current_module->title }}: {{$user->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	<div class="box-body">

	  <div class="col-sm-7 col-lg-9">
		<div class="form-group row">
			<div class="col-sm-3"><label>Nombres</label></div>
			<div class="col-sm-3">{{ $user->name }}</div>
			<div class="col-sm-3"><label>Apellidos</label></div>
			<div class="col-sm-3">{{ $user->lastname }}</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label>DNI</label></div>
			<div class="col-sm-3">{{ $user->username }}</div>
			<div class="col-sm-3"><label>Email</label></div>
			<div class="col-sm-3">{{ $user->email }}</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-3"><label>Fecha de registro</label></div>
			<div class="col-sm-3">{{ $created }}</div>
			<div class="col-sm-3"><label>Fecha de actualización</label></div>
			<div class="col-sm-3">{{ $updated }}</div>
		</div>
	  </div>
	  <div class="col-sm-12 col-lg-12">
		<div class="form-group row">

			<div class="col-sm-12 col-lg-12">
				<h4>Cotizaciones realizadas</h4>
				<table class="table table-bordered table-hover">
				<tr>
					<th class="col-sm-2">Fecha</th>
					<th class="col-sm-1"></th>
					<th class="col-sm-3"></th>
					<th class="col-sm-3"></th>
					<th class="col-sm-3"></th>
				</tr>
				</table>

			</div>
		</div>
	  </div>
	</div>
	<div class="box-footer">
		<a href="{{ route('member.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> regresar </a>
	</div>

<style>
.red{ color: red; }	
.green{ color: green; }	
</style>

</div>
@endsection
