@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$translate->alias}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($translate, ['url' => 'admin/translate/'.$translate->id, 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
	    {!! Form::hidden('lang_id', $lang->id) !!}

		@include('admin.translate.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
