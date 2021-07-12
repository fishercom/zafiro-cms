<?php

$imagen1 	=get_field($article->metadata, 'imagen1');
$icono 		=get_field($article->metadata, 'icono');
$imagen2 	=get_field($article->metadata, 'imagen2');

$dir_imagen=\App\Models\CmsDirectory::select()->where('alias', 'pagina_imagen')->first()->path;
$dir_icono=\App\Models\CmsDirectory::select()->where('alias', 'pagina_icono')->first()->path;

?>
	<div class="form-group">
		{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
	  {!! Form::label('metadata[imagen1]', 'Imagen Chica', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[imagen1]', $imagen1, ['class'=>'form-control fmanager', 'id'=>'media_imagen1', 'rel'=>$dir_imagen ]) !!}
	    </div>
	  </div>
	</div>

	<div class="form-group">
	  {!! Form::label('metadata[imagen2]', 'Imagen Mediana', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[imagen2]', $imagen2, ['class'=>'form-control fmanager', 'id'=>'media_imagen2', 'rel'=>$dir_imagen ]) !!}
	    </div>
	  </div>
	</div>

	<div class="form-group">
	  {!! Form::label('metadata[icono]', 'Ícono', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[icono]', $icono, ['class'=>'form-control fmanager', 'id'=>'media_icono', 'rel'=>$dir_icono ]) !!}
	    </div>
	  </div>
	</div>

	<div class="form-group">
	  {!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	  </div>
	</div>
