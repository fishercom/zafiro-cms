<?php

$status_list = Config::get('constants.company_status');

?>
@extends('layouts.admin')

@section('content')
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
{!! Form::open(['route' => 'company.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
        <div class="col-sm-10">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
{!! Form::close() !!}
    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-3">Razón Social</th>
        <th class="col-sm-1 text-center">RUC</th>
        <th class="col-sm-2 text-center">E-mail</th>
        <th class="col-sm-1 text-center">Estado</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($companys as $company)
    <?php
        $active = $company->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $company->name }}</td>
        <td>{{ $company->ruc }}</td>
        <td>{{ $company->member->user->email }}</td>
        <td class="text-center">{{ $status_list[$company->status_id] }}</td>
        <td>
        <a href="{{ url('/admin/store/?company_id='.$company->id) }}" class = "btn btn-primary btn-xs">
            <i class="glyphicon glyphicon-map-marker"></i> Locales
        </a>
        <a href="{{ route('company.edit', $company) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$company->id, 'method'=>'DELETE', 'route' => array('company.destroy', $company->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
        <label data-form="#frm_del-{{$company->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $company->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $companys->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" role="button" href="{{ route('company.create') }}">
    <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
