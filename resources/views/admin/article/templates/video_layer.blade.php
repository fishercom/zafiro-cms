<?php
$video=get_field($article->metadata, 'video');
$imagen=get_field($article->metadata, 'imagen');

$directory=get_directory('pagina_imagen');
?>
<div class="form-group">
	{!! Form::label('metadata[video]', 'Video (URL)', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::text('metadata[video]', $video, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('metadata[imagen]', 'Imagen Referencia', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	<div class="input-group">
		{!! Form::text('metadata[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_imagen', 'rel'=>$directory ]) !!}
	</div>
	</div>
</div>
