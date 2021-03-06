<?php
$parent_name=null;

if($parent_id!=null){
    //$parent = App\Models\CmsParameterLang::find(['parameter_id'=>$parent_id, 'lang_id'=>$lang_id]);
    $parent = App\Models\CmsParameter::find($parent_id);
    $parent_name='<i>&raquo; '.$parent->alias.'</i>';
}
?>
@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }} {!! $parent_name !!}</h2>
		<i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($parameter, ['url' => 'admin/parameter/'.$parameter->id, 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
	    {!! Form::hidden('group_id', $group_id) !!}
	    {!! Form::hidden('parent_id', $parent_id) !!}

		@include('admin.parameter.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
