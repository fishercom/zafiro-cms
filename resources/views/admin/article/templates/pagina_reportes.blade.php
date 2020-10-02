<?php
use App\Util\Status;

$status_list=Status::get_list();

$status=get_field($article->metadata, 'status');
?>
	<div class="form-group">
		{!! Form::label('metadata[status]', 'Status', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::select('metadata[status]', $status_list, $status, ['class'=>'form-control']) !!}
		</div>
	</div>
