<?php
$imagen=get_field($article->metadata, 'imagen');
$video=get_field($article->metadata, 'video');

$directory=\App\Models\CmsDirectory::select()->where('alias', 'galeria_video')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('metadata[imagen]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_video', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
		{!! Form::label('metadata[video]', 'Video (youtube)', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::text('metadata[video]', $video, ['class'=>'form-control']) !!}
		</div>
	</div>
