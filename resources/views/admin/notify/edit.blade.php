@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$notify->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($notify, ['route' => ['notify.update', $notify], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
		{!! Form::hidden('module_id', $current_module->id) !!}
        {!! Form::hidden('form_id', $form_id) !!}

		@include('admin.notify.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
