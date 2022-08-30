<?php
$icono=get_field($article->metadata, 'icono');

$directory=get_directory('widget_imagen');
?>
<div class="form-group">
	{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	    {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('metadata[icono]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	<div class="input-group">
		{!! Form::text('metadata[icono]', $icono, ['class'=>'form-control fmanager', 'id'=>'media_icono', 'rel'=>$directory ]) !!}
	</div>
	</div>
</div>
<div class="form-group">
	{!! Form::label('resumen', 'Resumen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('resumen', null, ['class'=>'form-control ckeditor']) !!}
	</div>
</div>
