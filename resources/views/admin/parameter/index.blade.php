<?php

$has_children=App\CmsParameterGroup::find($group_id)->children;
$parent_name = null;

if($parent_id!=null){
//    $parent = App\CmsParameterLang::find(['parameter_id'=>$parent_id, 'lang_id'=>$lang_id]);
    $parent = App\CmsParameter::find($parent_id);
    $parent_name='<i>&raquo; '.$parent->alias.'</i>';
}
?>
@extends('layouts.admin')

@section('content')
<script type="text/javascript">
function Filter(sender){
    frm = sender.form;
    if(sender.name=='group_id') frm['parent_id'].value='';
    frm.submit();
}
</script>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }} {!! $parent_name !!}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'parameter.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('parent_id', $parent_id) !!}
    <div class="form-group">
        <div class="col-sm-5">
            {!! Form::select('group_id', $groups, $group_id, ['class'=>'form-control', 'onchange'=>'Filter(this)']) !!}
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
        <th class="col-sm-9">Nombre</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($parameters_pg as $parameter)
    <?php
        $url_child = url('admin/parameter').'?group_id='.$parameter->group_id.'&parent_id='.$parameter->id;
        $url_edit = route('parameter.edit', $parameter).$module_params;
        $active = $parameter->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>
        @if($has_children && is_null($parameter->parent_id))
            <a href="{{ $url_child }}">{{ $parameter->name }}</a>
        @else
            {{ $parameter->name }}
        @endif
        </td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ $url_edit }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$parameter->id, 'method'=>'DELETE', 'route' => array('parameter.destroy', $parameter->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('group_id', $group_id) !!}
            {!! Form::hidden('parent_id', $parent_id) !!}
        <label data-form="#frm_del-{{$parameter->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $parameter->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $parameters_pg->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" id="btn_add" role="button" href="{{ route('parameter.create') }}{{ $module_params }}">
    <span class="fa fa-plus"></span> nuevo {{ $current_module->title }} </a>
    <button type="button" id="btn_sort" class="btn btn-warning" data-toggle="modal" data-target="#sort_modal"><i class="fa fa-sort"></i> ordenar</button>
<?php
if($parent_id!=NULL){
?>
    <a class="btn btn-danger" role="button" href="{{ route('parameter.index') }}{{ '?group_id='.$group_id }}">
    <span class="fa fa-arrow-left"></span> Regresar </a>
<?php
    }
?>

  </div>
</div>

<!-- Modal Dialog -->
@include('admin.parameter.partials.sort_list')
@include('admin.partials.delete_confirm')

@endsection
