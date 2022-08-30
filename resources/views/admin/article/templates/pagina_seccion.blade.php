<?php

$background=get_field($article->metadata, 'background');
$banner_text=get_field($article->metadata, 'banner_text');

$directory_background=get_directory('seccion_background');
?>

<div class="form-group">
	{!! Form::label('metadata[background]', 'Background', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	<div class="input-group">
		{!! Form::text('metadata[background]', $background, ['class'=>'form-control fmanager', 'id'=>'media_background', 'rel'=>$directory_background ]) !!}
	</div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('metadata[banner_text]', 'Texto Intro', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('metadata[banner_text]', $banner_text, ['class'=>'form-control', 'rows'=>'4']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	    {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	</div>
</div>
