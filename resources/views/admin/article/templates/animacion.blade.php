<?php
$background=get_field($article->metadata, 'background');

$directory=\App\Models\CmsDirectory::select()->where('alias', 'animacion_home')->first()->path;
?>
<div class="form-group">
	  {!! Form::label('resumen', 'Contenido', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('resumen', null, ['class'=>'form-control']) !!}
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