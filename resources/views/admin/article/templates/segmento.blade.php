<?php
$worker=get_field($article->metadata, 'worker');

$worker_list=App\Util\Worker::get_list();
?>
	<div class="form-group">
		{!! Form::label('metadata[worker]', 'Tipo de Empleado', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::select('metadata[worker]', $worker_list, $worker, ['class'=>'form-control']) !!}
		</div>
	</div>
