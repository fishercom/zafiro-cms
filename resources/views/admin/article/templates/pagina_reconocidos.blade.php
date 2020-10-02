<?php

$tipo_list=[ 
	''=>'--seleccione--',
	'diario'=>'Diario',
	'semanal'=>'Semanal',
	'quincenal'=>'Quincenal',
	'mensual'=>'Mensual'
];

$tipo_reporte=get_field($article->metadata, 'tipo_reporte');
?>
	<div class="form-group">
		{!! Form::label('metadata[tipo_reporte]', 'Tipo de Reporte', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::select('metadata[tipo_reporte]', $tipo_list, $tipo_reporte, ['class'=>'form-control']) !!}
		</div>
	</div>
