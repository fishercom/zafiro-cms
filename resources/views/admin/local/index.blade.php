<?php

$company_list = \App\Company::select()->orderBy('name')->pluck('name', 'id');

?>
@extends('layouts.admin')

@section('content')
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
{!! Form::open(['route' => 'local.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
        <div class="col-sm-5">
            {!! Form::select('company_id', $company_list, $company_id, ['placeholder'=>'Empresa', 'class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-5">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
{!! Form::close() !!}
    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-3">Nombre</th>
        <th class="col-sm-3">Empresa</th>
        <th class="col-sm-3">Departamento - Provincia - Distrito</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($locals as $local)
    <?php
        $active = $local->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $local->name }}</td>
        <td>{{ $local->company->name }}</td>
        <td>
            {{ $local->department_id? $local->department->name: null }} -
            {{ $local->province_id? $local->province->name: null }} -
            {{ $local->district_id? $local->district->name: null }} 
        </td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('local.edit', $local) }}{{ $module_params }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$local->id, 'method'=>'DELETE', 'route' => array('local.destroy', $local->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
        <label data-form="#frm_del-{{$local->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $local->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $locals->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" role="button" href="{{ route('local.create') }}{{ $module_params }}">
    <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
