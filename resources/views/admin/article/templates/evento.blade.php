<?php
$imagen=get_field($article->metadata, 'imagen');
$directory=\App\CmsDirectory::select()->where('alias', 'evento_imagen')->first()->path;
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

<script type="text/javascript">
$(document).ready(function(){
	CKEDITOR.replace( 'resumen',
    {
        toolbar : 'Basic',
        height:"100"
    });
	$.fn.datepicker.defaults.format = "yyyy-mm-dd";
});
</script>
