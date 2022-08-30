<?php
$group=\App\Models\CmsParameterGroup::select()->where('alias', 'categoria')->first();
$categoria_list = $group->parameters;

$imagen=get_field($article->metadata, 'imagen');
$categorias=get_field($article->metadata, 'categorias');
$date = $article->date? date('Y-m-d', strtotime($article->date)): null;

$directory=get_directory('noticia_imagen');
?>
<div class="form-group">
	{!! Form::label('date', 'Fecha', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::date('date', $date, ['class'=>'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('metadata[categorias][]', 'Categorías', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		@foreach($categoria_list as $item)
		<label>
		{!! Form::checkbox('metadata[categorias][]', $item->id, is_array($categorias) && in_array($item->id, $categorias), ['class'=>'form-control']) !!}
		{{ $item->name }}
		</label> &nbsp;
		@endforeach
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
		{!! Form::textarea('resumen', null, ['class'=>'form-control ckeditor']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	</div>
</div>
