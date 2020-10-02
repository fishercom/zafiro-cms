<?php
$icono_menu=get_field($article->metadata, 'icono_menu');

$directory=\App\CmsDirectory::select()->where('alias', 'pagina_icono')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('metadata[icono_menu]', 'Ícono Menú', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[icono_menu]', $icono_menu, ['class'=>'form-control fmanager', 'id'=>'media_icono_menu', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
