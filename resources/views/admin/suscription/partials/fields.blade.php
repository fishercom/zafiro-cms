<?php

use App\Service;
use App\Models\CmsLang;

$services = [null=>'--seleccione--']+Service::select(DB::Raw("CONCAT(name, ' (US$', amount, ')') as name"), 'id')
		->pluck('name', 'id')->toArray();
		//->where('service_type', 'MEMBERSHIP')->pluck('name', 'id')->toArray();
$member_types = [null=>'--seleccione--']+Config::get('constants.member_type');
$plan_types = [null=>'No Aplica']+Config::get('constants.plan_type');
$langs = CmsLang::where('active', true)->get();
$metadata = isset($suscription->metadata)? $suscription->metadata: array();
?>
<div class="box-body">

@foreach($langs as $lang)
	<div class="form-group">
		{!! Form::label('metadata[name_'.$lang->iso.']', 'Nombre ['.$lang->name.']', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::text('metadata[name_'.$lang->iso.']', null, ['required'=>true, 'class'=>'form-control', 'placeholder'=>'Nombre ['.$lang->name.']']) !!}
		</div>
	</div>
@endforeach

	<div class="form-group">
		{!! Form::label('service_id', 'Servicio', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			{!! Form::select('service_id', $services, null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('member_type', 'Tipo de Usuario', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			{!! Form::select('member_type', $member_types, null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('plan_type', 'Tipo de Plan', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			{!! Form::select('plan_type', $plan_types, null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('lifetime', 'Vigencia (días)', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::number('lifetime', null, ['class'=>'form-control']) !!}
		</div>
	</div>

@foreach($langs as $lang)
	<div class="form-group">
		{!! Form::label('metadata[description_'.$lang->iso.']', 'Descripción ['.$lang->name.']', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::textarea('metadata[description_'.$lang->iso.']', null, ['class'=>'form-control', 'rows'=>'5', 'placeholder'=>'Detalle de la suscripción ['.$lang->name.']']) !!}
		</div>
	</div>
@endforeach

	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			<label>
		{!! Form::checkbox('renewable', '1') !!}
		Es Renovable
			</label>
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			<label>
		{!! Form::checkbox('active', '1') !!}
		Activo
			</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('suscription.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
