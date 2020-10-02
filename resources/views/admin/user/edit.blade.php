@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$user->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($user, ['route' => ['user.update', $user], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}

		@include('admin.user.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
