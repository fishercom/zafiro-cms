<?php

$tipo_list=[ 
	''=>'--seleccione--',
	'btn_registrate'=>'Regístrate',
	'btn_direccion'=>'Ubica tu dirección',
	'btn_preguntas'=>'Preguntas Frecuentes',
	'btn_carrito'=>'Carrito de Compras',
	'btn_terminos'=>'Términos y Condiciones'
];

$estilo=get_field($article->metadata, 'estilo');
?>
	<div class="form-group">
		{!! Form::label('metadata[estilo]', 'Estilo de Menú', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::select('metadata[estilo]', $tipo_list, $estilo, ['class'=>'form-control']) !!}
		</div>
	</div>

	@include('admin.article.partials.enlace')
