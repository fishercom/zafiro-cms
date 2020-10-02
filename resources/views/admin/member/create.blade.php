@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Crear {{ $current_module->title }}:</h2><i class="fa fa-close pull-right" onclick="javascript: history.back();"></i>
	</div>
	
	{!! Form::open(['route' => 'member.store', 'method'=>'POST', 'id'=>'post_form', 'class'=>'form-horizontal']) !!}

		@include('admin.member.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
