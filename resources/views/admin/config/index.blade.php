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
<!--
    <tr>
      <td>Google oAuth 2</td>
      <td>
{!! Form::model(null, ['route' => ['config.test_mail', null], 'method'=>'POST', 'class'=>'form-horizontal']) !!}
    <div class="row">
      <div class="col-sm-6">
        {!! Form::email('email', null, ['class'=>'form-control', 'required'=>true, 'placeholder'=>'E-mail de prueba']) !!}
      </div>
      <div class="col-sm-6">
        <button type="submit" class="btn btn-success"><span class="fa fa-envelope"></span> Test Mail </button>
        <a class="btn btn-primary" role="button" href="{{ url('/admin/config/google_oauth/login') }}">
        <span class="fa fa-rss"></span> Refrescar Token </a>
      </div>
    </div>
    @if(Session::has('status'))
      <span class="badge label label-primary">
        {{Session::get('status')}}
      </span>
    @endif
{!! Form::close() !!}
      </td>
      <td>
      </td>
  </tr>
-->
  </table>
    {!! $configs->render() !!}
  </div>
  <div class="box-footer">
  </div>
</div>

@endsection
