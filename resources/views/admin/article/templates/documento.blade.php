<?php
$documento=get_field($article->metadata, 'documento');

$directory=\App\Models\CmsDirectory::select()->where('alias', 'pagina_documento')->first()->path;
?>
		<div class="form-group">
		  {!! Form::label('metadata[documento]', 'Documento', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		  <div class="col-sm-9 col-lg-11">
		    <div class="input-group">
		      {!! Form::text('metadata[documento]', $documento, ['class'=>'form-control fmanager', 'id'=>'media_documento', 'rel'=>$directory ]) !!}
		    </div>
		  </div>
		</div>
