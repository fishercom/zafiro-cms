@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> <?php echo $current_module->name; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

  {!! Form::open(['route' => 'log.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
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
        <div class="col-sm-6">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por usuario" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
  {!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-2">Fecha</th>
        <th class="col-sm-2">Usuario</th>
        <th class="col-sm-6">Comentario</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($logs as $log)
    <?php
        $active = $log->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $log->created_at }}</td>
        <td>{{ $log->user->name }}</td>
        <td>{{ $log->comment }}</td>
        <td>
        <a href="{{ route('log.show', $log) }}" class="btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-search"></i> Ver
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$log->id, 'method'=>'DELETE', 'route' => array('log.destroy', $log->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
        <label data-form="#frm_del-{{$log->id}}" data-title="Eliminar Perfil" data-message="Esta seguro que desea eliminar <strong>'{{ $log->comment }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $logs->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-warning" role="button" href="{{ url('/admin/log?export=true') }}">
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
