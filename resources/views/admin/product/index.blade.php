@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
{!! Form::open(['route' => 'product.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
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
        <th class="col-sm-4">Nombre</th>
        <th class="col-sm-3">Categoría</th>
        <th class="col-sm-2">Marca</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($products as $product)
    <?php
        $active = $product->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category? $product->category->name: null }}{{ $product->subcategory? ' / '.$product->subcategory->name: null }}</td>
        <td>{{ $product->brand? $product->brand->name: null }}</td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('product.edit', $product) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$product->id, 'method'=>'DELETE', 'route' => array('product.destroy', $product->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
        <label data-form="#frm_del-{{$product->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $product->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $products->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" role="button" href="{{ route('product.create') }}">
    <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
