<?php

use App\Models\CmsParameterGroup;
use App\Models\CmsLang;

$group = CmsParameterGroup::find($group_id);
$langs = CmsLang::where('active', '1')->get();

$metadata = $parameter->metadata;
?>
<div class="box-body">
	<div class="form-group">
		{!! Form::label('null', 'Nombre', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::text('name', null, ['class'=>'form-control', 'required'=>true]) !!}
		</div>
	</div>
@foreach($langs as $lang)
	<div class="form-group">
		{!! Form::label('metadata[value_'.$lang->iso.']', 'Nombre ['.$lang->name.']', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::text('metadata[value_'.$lang->iso.']', null, ['class'=>'form-control', 'required'=>true]) !!}
		</div>
	</div>
@endforeach
	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			<label>{!! Form::checkbox('active', '1', $parameter->active) !!}Activo</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('parameter.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
