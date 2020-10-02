<div class="box-body">
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
    <div class="col-sm-9 col-lg-11">
      {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('admin_view', 'Vista Admin', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
    <div class="col-sm-9 col-lg-11">
      {!! Form::text('admin_view', null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('front_view', 'Vista Pública', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
    <div class="col-sm-9 col-lg-11">
      {!! Form::text('front_view', null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('iterations', 'Repetir', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
    <div class="col-sm-9 col-lg-11">
      {!! Form::input('number', 'iterations', null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
    <label class="col-sm-9 col-lg-11">
      {!! Form::checkbox('is_page', 1) !!}
      Es página
    </label>
  </div>
	<div class="form-group">
    {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<label class="col-sm-9 col-lg-11">
		  {!! Form::checkbox('active', 1) !!}
			Activo
		</label>
	</div>
</div>

<div class="box-footer">
  <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
  <a href="{{ route('schema.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
