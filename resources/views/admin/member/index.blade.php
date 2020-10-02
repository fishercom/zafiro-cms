<?php

$status_list = Config::get('constants.member_status');

?>
@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> <?php echo $current_module->name; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'member.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    <div class="form-group">
        <div class="col-sm-10">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Buscar</button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-4">Apellido, Nombres</th>
        <th class="col-sm-2">Email</th>
        <th class="col-sm-1">Document</th>
        <th class="col-sm-1 text-center">Estado</th>
        <th class="col-sm-3">Acciones</th>
    </tr>
    @foreach ($members as $member)
    <?php
        $active = $member->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $member->lastname }}, {{ $member->name }}</td>
        <td>{{ $member->email }}</td>
        <td>{{ $member->document }}</td>
        <td class="text-center">{{ $status_list[$member->status] }}</td>
        <td>
        <a href="{{ route('member.show', $member) }}" class = "btn btn-primary btn-xs">
            <i class="glyphicon glyphicon-plus-sign"></i> Detalles
        </a>
        <a href="{{ route('member.edit', $member) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        @if(!$member->default)
        {!! Form::open(array('id'=>'frm_del-'.$member->id, 'method'=>'DELETE', 'route' => array('member.destroy', $member->id), 'style' => 'display:inline'
        )) !!}
        <label data-form="#frm_del-{{$member->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $member->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        @endif
        </td>
    </tr>
    @endforeach
    </table>
    {!! $members->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" role="button" href="{{ route('member.create') }}">
        <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importer" data-backdrop="static" data-keyboard="false">
        <span class="glyphicon glyphicon-import"></span> importar</button>

    <a class="btn btn-warning" role="button" href="{{ url('/admin/member') }}?export=true&filter={{ $filter }}&sdate=&edate=">
        <span class="fa fa-download"></span> descargar </a>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importer" tabindex="-1" role="dialog" aria-labelledby="titleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="titleLabel">Importar Usuarios</h3>
      </div>
      <div class="modal-body">
    {!! Form::open(['url' => '/admin/member/import', 'method'=>'POST', 'id'=>'frm_import', 'class'=>'form-horizontal']) !!}
        <div class="form-group">
            <div class="col-sm-9">
                <input name="file" class="form-control" type="file" id="file" value="{{ $filter }}" required="true" placeholder="Buscar por nombre" />
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-import"></span> Importar CSV</button>
                <!-- <button class="btn btn-success"><i class="fa fa-refresh fa-spin fa-fw"></i> Cargando ...</button> /-->
            </div>
        </div>
    {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
