@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$suscription->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($suscription, ['route' => ['suscription.update', $suscription], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
		{!! Form::hidden('module_id', $current_module->id) !!}
        {!! Form::hidden('site_id', $site_id) !!}

		@include('admin.suscription.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
