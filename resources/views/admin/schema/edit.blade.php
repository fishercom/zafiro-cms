@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{$current_module->name}}: {{$schema->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>
	
	{!! Form::model($schema, ['url' => ['admin/schema', $schema], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
		{!! Form::hidden('module_id', $current_module->id) !!}
        {!! Form::hidden('parent_id', $parent->id) !!}
        {!! Form::hidden('group_id', $group->id) !!}

		@include('admin.schema.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
