<?php

$image_menu=get_field($article->metadata, 'image_menu');
$background=get_field($article->metadata, 'background');
$show_page=get_field($article->metadata, 'show_page');
$class_menu=get_field($article->metadata, 'class_menu');
$banner_text=get_field($article->metadata, 'banner_text');

$directory_imagen=get_directory('seccion_imagen');
$directory_background=get_directory('seccion_background');
?>
<div class="form-group">
	{!! Form::label('metadata[image_menu]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	<div class="input-group">
		{!! Form::text('metadata[image_menu]', $image_menu, ['class'=>'form-control fmanager', 'id'=>'media_image_menu', 'rel'=>$directory_imagen ]) !!}
	</div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('metadata[background]', 'Background', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	<div class="input-group">
		{!! Form::text('metadata[background]', $background, ['class'=>'form-control fmanager', 'id'=>'media_background', 'rel'=>$directory_background ]) !!}
	</div>
	</div>
</div>

<div class="form-group">
	{!! Form::label('metadata[class_menu]', 'Class CSS', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::text('metadata[class_menu]', $class_menu, ['class'=>'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('metadata[banner_text]', 'Texto Intro', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('metadata[banner_text]', $banner_text, ['class'=>'form-control', 'rows'=>'4']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<label class="col-sm-9 col-lg-11">
		{!! Form::checkbox('metadata[show_page]', 1, $show_page) !!}
		Ver como página
	</label>
</div>
