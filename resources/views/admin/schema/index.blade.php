@extends('layouts.admin')
@section('content')
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> <?php echo $current_module->name; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

  {!! Form::open(['route' => 'schema.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    {!! Form::hidden('parent_id', null) !!}
    <div class="form-group">
        <div class="col-sm-12 col-lg-3">
            {!! Form::select('group_id', $groups, $group->id, ['class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
    </div>
  {!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-5">Plantilla</th>
        <th class="col-sm-1 text-center">Repetir</th>
        <th class="col-sm-2 text-center">Fecha Registro</th>
        <th class="col-sm-1 text-center">Página</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($schemas_pg as $schema)
    <?php
        $title=$schema->name;
        $url = url('admin/schema').'?parent_id='.$schema->id.'&group_id='.$schema->group_id;
        $is_page = $schema->is_page? '<i class="fa fa-check"></i>' : NULL;
        $active = $schema->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td><a href="{{ $url }}">{{ $title }}</a></td>
        <td class="text-center">{{ $schema->iterations }}</td>
        <td class="text-center">{{ $schema->created_at }}</td>
        <td class="text-center">{!! $is_page !!}</td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('schema.edit', $schema->id) }}{{ $module_params }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$schema->id, 'method'=>'DELETE', 'route' => array('schema.destroy', $schema->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('parent_id', $parent->id) !!}
            {!! Form::hidden('group_id', $group->id) !!}
        <label data-form="#frm_del-{{$schema->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="¿Esta seguro que desea eliminar <strong>'{{ $title }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $schemas_pg->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" role="button" href="{{ route('schema.create') }}{{ $module_params }}">
    <span class="fa fa-plus"></span> nuevo {{ $current_module->title }} </a>
    <button type="button" id="btn_sort" class="btn btn-warning" data-toggle="modal" data-target="#sort_modal"><i class="fa fa-sort"></i> ordenar</button>
<?php
if($parent->id!=NULL){
?>
    <a class="btn btn-danger" role="button" href="{{ route('schema.index') }}{{ '?parent_id='.$parent->parent_id.'&group_id='.$group->id }}">
    <span class="fa fa-arrow-left"></span> Regresar </a>
<?php
    }
?>
  </div>
</div>

<!-- Modal Dialog -->
@include('admin.schema.partials.sort_list')
@include('admin.partials.delete_confirm')

@endsection
