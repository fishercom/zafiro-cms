@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Crear contenido</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($article, ['route' => 'article.store', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
	    {!! Form::hidden('schema_id', $schema->id) !!}
        {!! Form::hidden('parent_id', $parent->id) !!}
	    {!! Form::hidden('lang_id', $lang->id) !!}
	    {!! Form::hidden('site_id', $site->id) !!}
	    {!! Form::hidden('page', $page) !!}

		@include('admin.article.partials.fields')

	{!! Form::close() !!}
</div>

<script type="text/javascript">
	$(document).ready(function(){
	CKEDITOR.replace( 'resumen',
		{
			toolbar : 'Basic',
			height:"100"
		});
	});
</script>
	
@endsection
