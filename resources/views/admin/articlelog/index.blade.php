@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'articlelog.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
        <div class="col-sm-3">
            {!! Form::select('worker', $tipos, $worker, ['class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-3">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre o email" />
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
        <th class="col-sm-4">Nombre</th>
        <th class="col-sm-3">Email</th>
        <th class="col-sm-2">Fecha</th>
        <th class="col-sm-1">Acciones</th>
    </tr>
    @foreach ($users as $user)
    <?php
        $params = '?worker='.$worker.'&page='.$page;
    ?>
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td>
        <a href="{{ route('webuser.show', $user) }}{{ $params }}" target="_blank" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-search"></i> Ver
        </a>
        </td>
    </tr>
    @endforeach
    </table>
    {!! $users->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-warning" role="button" href="{{ url('/admin/articlelog') }}{{ $module_params }}&export=true&filter={{ $filter }}&sdate={{ $sdate }}&edate={{ $edate }}">
    <span class="fa fa-download"></span> descargar reporte</a>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
});
</script>
@include('admin.partials.delete_confirm')

@endsection
