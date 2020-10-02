<div class="box-body">

	<div class="form-group">
		{!! Form::label('name', 'Nombre', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('metadata[estilo]', 'Tipo de archivo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::select('type_id', $ftypes, null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('alias', 'Alias', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('alias', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('path', 'Ruta', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('path', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
			<label>
		{!! Form::checkbox('active', '1') !!}
		Activo
			</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('directory.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
