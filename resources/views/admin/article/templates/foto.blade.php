<?php
$imagen=get_field($article->metadata, 'imagen');
$directory=\App\CmsDirectory::select()->where('alias', 'galeria_imagen')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('metadata[imagen]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_imagen', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
