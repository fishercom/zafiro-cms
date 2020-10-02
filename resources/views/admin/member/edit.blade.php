@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$user->name}} {{$user->lastname}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($member, ['route' => ['member.update', $member], 'method'=>'PUT', 'id'=>'post_form', 'class'=>'form-horizontal']) !!}

		@include('admin.member.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
