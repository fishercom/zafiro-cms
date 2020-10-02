@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> <?php echo $current_module->name; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'user.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
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
        <th class="col-sm-3">Nombre</th>
        <th class="col-sm-3">Apellido</th>
        <th class="col-sm-2">Email</th>
        <th class="col-sm-1">Perfil</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($users as $user)
    <?php
        $active = $user->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->profile->name }}</td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('user.edit', $user) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        @if(!$user->default)
        {!! Form::open(array('id'=>'frm_del-'.$user->id, 'method'=>'DELETE', 'route' => array('user.destroy', $user->id), 'style' => 'display:inline'
        )) !!}
        <label data-form="#frm_del-{{$user->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $user->name }}'</strong>?" >
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
    {!! $users->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" role="button" href="{{ route('user.create') }}">
    <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
