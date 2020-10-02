<div class="box-body">

	<div class="form-group">
		{!! Form::label('user_id', 'Usuario', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
			{!! Form::select('user_id', $users, null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
	  {!! Form::label('recipients', 'Cuentas Adicionales', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('recipients', null, ['class'=>'form-control']) !!}
	      <p>Usar texto delimitado por comas. Ej. <strong>jperez@mail.com,mdiaz@mail2.com</strong></p>
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
	<a href="{{ route('notify.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
