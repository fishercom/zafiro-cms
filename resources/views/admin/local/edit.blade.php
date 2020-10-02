@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$local->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($local, ['route' => ['local.update', $local], 'method'=>'PUT', 'id'=>'post_form', 'class'=>'form-horizontal']) !!}
		{!! Form::hidden('module_id', $current_module->id) !!}

		@include('admin.local.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
