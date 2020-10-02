@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-3">Parámetro</th>
        <th class="col-sm-7">Valor</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($configs as $config)
    <tr>
        <td>{{ $config->name }}</td>
        <td>{{ $config->value }}</td>
        <td>
        <a href="{{ route('config.edit', $config) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        </td>
    </tr>
    @endforeach
    </table>
    {!! $configs->render() !!}
  </div>
  <div class="box-footer">
  </div>
</div>

@endsection
