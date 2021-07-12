<?php

use \App\Models\CmsDirectory;

$directory = CmsDirectory::select()->where('alias', 'dashboard_icono')->first()->path;

$menu_list=[''=>'--seleccione--']+Config::get('constants.dashboard');
$permiso_list = ['ALL_USERS'=>'Todos los usuarios']+Config::get('constants.member_type');

$icono = get_field($metadata, 'icono');
$permisos = get_field($metadata, 'permisos');
$resumen = get_field($metadata, 'resumen');

if(empty($permisos)) $permisos=[];
?>
	<div class="form-group">
		{!! Form::label('value', 'Módulo', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		  {!! Form::select('value', $menu_list, $parameter->value, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
	  {!! Form::label('metadata[icono]', 'Ícono', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
	  <div class="col-sm-9 col-lg-10">
	    <div class="input-group">
	      {!! Form::text('metadata[icono]', $icono, ['class'=>'form-control fmanager', 'id'=>'metadata_icono', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
@foreach($langs as $lang)
	<div class="form-group">
		{!! Form::label('metadata[resumen_'.$lang->iso.']', 'Resumen ['.$lang->name.']', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::textarea('metadata[resumen_'.$lang->iso.']', null, ['rows'=>3, 'class'=>'form-control', 'required'=>true]) !!}
		</div>
	</div>
@endforeach
	<div class="form-group">
		{!! Form::label('', 'Permisos', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			@foreach($permiso_list as $key=>$name)
			<label>{!! Form::checkbox('metadata[permisos][]', $key, (in_array($key, $permisos)? $key: null)) !!} {{ $name }}</label>
			@endforeach
		</div>
	</div>
