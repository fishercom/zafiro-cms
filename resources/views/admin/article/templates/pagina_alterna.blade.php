<?php

?>
<div class="form-group">
	{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
	    {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	</div>
</div>
