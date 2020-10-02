<?php
$icono=get_field($article->metadata, 'icono');

$directory=\App\CmsDirectory::select()->where('alias', 'pagina_icono')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('metadata[icono]', 'Imagen (icono)', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[icono]', $icono, ['class'=>'form-control fmanager', 'id'=>'media_icono', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	  </div>
	</div>
