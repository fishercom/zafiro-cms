<?php
$group=\App\Models\CmsParameterGroup::select()->where('alias', 'tipo_post')->first();
$tipo_list = [null => '--seleccione--'] + $group->parameters
	->where('parent_id', NULL)
	->pluck('name', 'id')
	->toarray();

$imagen=get_field($article->metadata, 'imagen');
$tipo_id=get_field($article->metadata, 'tipo_id');

$directory=\App\Models\CmsDirectory::select()->where('alias', 'noticia_imagen')->first()->path;
?>
	<div class="form-group">
		{!! Form::label('date', 'Fecha', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  <div class="input-group date" data-provide="datepicker">
			{!! Form::text('date', null, ['class'=>'form-control datepicker']) !!}
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-th"></span>
			</div>
		  </div>
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('metadata[tipo_id]', 'Categoría', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::select('metadata[tipo_id]', $tipo_list, $tipo_id, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
	  {!! Form::label('metadata[imagen]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_imagen', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('resumen', 'Resumen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('resumen', null, ['class'=>'form-control']) !!}
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	  </div>
	</div>
