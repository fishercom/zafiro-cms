<?php

use App\Models\CmsSchemaGroup;

$sch_groups = [null=>'--seleccione--']+CmsSchemaGroup::select('name', 'id')
		->where('active', true)->pluck('name', 'id')->toArray();
?>
<div class="box-body">

	<div class="form-group">
		{!! Form::label('name', 'Nombre', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('segment', 'Segmento', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('segment', null, ['class'=>'form-control', 'placeholder'=>'Segmento del subdominio']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('site_url', 'URL del Site', ['class'=>'col-sm-3 col-lg-1 control-label', 'placeholder'=>'https://']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('site_url', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('schema_group_id', 'Esquema del Site', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
			{!! Form::select('schema_group_id', $sch_groups, null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('metadata[analytics]', 'Google Analytics', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('metadata[analytics]', null, ['class'=>'form-control', 'rows'=>4]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('metadata[postmaster]', 'Correo Postmaster', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('metadata[postmaster]', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
			<label>
		{!! Form::checkbox('active', '1') !!} Activo
			</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('site.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
