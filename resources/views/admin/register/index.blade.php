@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'register.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
        <div class="col-sm-3">
            {!! Form::select('form_id', $forms, $form_id, ['class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-3">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre, apellido, email" />
        </div>
        <div class="col-sm-2">
          <div class="input-group date" data-provide="datepicker">
            {!! Form::text('sdate', $sdate, ['class'=>'form-control datepicker', 'placeholder'=>'Fecha Inicio']) !!}
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="input-group date" data-provide="datepicker">
            {!! Form::text('edate', $edate, ['class'=>'form-control datepicker', 'placeholder'=>'Fecha Fin']) !!}
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-3">Nombres</th>
        <th class="col-sm-3">Apellidos</th>
        <th class="col-sm-2">Email</th>
        <th class="col-sm-2">Fecha</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($registers as $register)
    <?php
        $params = '?form_id='.$register->form_id.'&page='.$page;
    ?>
    <tr>
        <td>{{ $register->first_name }}</td>
        <td>{{ $register->last_name }}</td>
        <td>{{ $register->email }}</td>
        <td>{{ $register->created_at }}</td>
        <td>
        <a href="{{ route('register.show', $register) }}{{ $params }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-search"></i> Ver
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$register->id, 'method'=>'DELETE', 'route' => array('register.destroy', $register->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
            {!! Form::hidden('form_id', $form_id) !!}
        <label data-form="#frm_del-{{$register->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $register->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $registers->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-warning" role="button" href="{{ url('/admin/register') }}{{ $module_params }}&export=true">
    <span class="fa fa-download"></span> descargar </a>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
});
</script>
@include('admin.partials.delete_confirm')

@endsection
