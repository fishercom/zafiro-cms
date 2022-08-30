<?php
$background=get_field($article->metadata, 'background');

$directory=get_directory('animacion_home');
?>
<div class="form-group">
	{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	    {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('metadata[background]', 'Imagen de Fondo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		<div class="input-group">
			{!! Form::text('metadata[background]', $background, ['class'=>'form-control fmanager', 'id'=>'metadata_background', 'rel'=>$directory ]) !!}
		</div>
	</div>
</div>
<div class="form-group">
	{!! Form::label('resumen', 'Texto', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	    {!! Form::textarea('resumen', null, ['class'=>'form-control ckeditor']) !!}
	</div>
</div>