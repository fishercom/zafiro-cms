<div class="box-body">

	<div class="form-group">
		{!! Form::label('value', $config->name, ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
	@if($config->type=='text')
		{!! Form::textarea('value', null, ['class'=>'form-control']) !!}
	@else
		{!! Form::text('value', null, ['class'=>'form-control']) !!}
	@endif
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('config.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
