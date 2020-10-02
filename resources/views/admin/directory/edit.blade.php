@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$directory->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($directory, ['route' => ['directory.update', $directory], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}

		@include('admin.directory.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
