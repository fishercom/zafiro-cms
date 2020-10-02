@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'notify.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
        <div class="col-sm-5">
            {!! Form::select('form_id', $forms, $form_id, ['class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-5">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por email" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-3">Nombre</th>
        <th class="col-sm-6">Cuentas Adicionales</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($notifies as $notify)
    <?php
        $active = $notify->active? '<i class="fa fa-check"></i>' : NULL;
        $params = '?form_id='.$notify->form_id.'&page='.$page;
    ?>
    <tr>
        <td>{{ $notify->user->name }}</td>
        <td>{{ $notify->recipients }}</td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('notify.edit', $notify) }}{{ $params }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$notify->id, 'method'=>'DELETE', 'route' => array('notify.destroy', $notify->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
            {!! Form::hidden('form_id', $form_id) !!}
        <label data-form="#frm_del-{{$notify->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $notify->user_id }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $notifies->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" id="btn_add" role="button" href="{{ route('notify.create') }}{{ $module_params }}">
    <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
