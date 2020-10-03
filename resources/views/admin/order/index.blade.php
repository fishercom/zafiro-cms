@extends('layouts.admin')

@section('content')
<?php

$status_list = Config::get('constants.order_status');

?>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
{!! Form::open(['route' => 'order.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    <div class="form-group">
        <div class="col-sm-2">
            {!! Form::date('start_date', $start_date, ['class'=>'form-control datepicker', 'placeholder'=>'Fecha Inicio']) !!}
        </div>
        <div class="col-sm-2">
            {!! Form::date('end_date', $end_date, ['class'=>'form-control datepicker', 'placeholder'=>'Fecha Fin']) !!}
        </div>
        <div class="col-sm-2">
            {!! Form::select('status', $status_list, $status, ['class'=>'form-control', 'placeholder'=>'Estado', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-4">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por Nombre, RUC o Razón Social" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
{!! Form::close() !!}
    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-2">Fecha</th>
        <th class="col-sm-2">Empresa / Local</th>
        <th class="col-sm-2">Cliente</th>
        <th class="col-sm-3">Producto</th>
        <th class="col-sm-1 text-right">Monto</th>
        <th class="col-sm-1 text-center">Estado</th>
        <th class="col-sm-1">Acciones</th>
    </tr>
    @foreach ($orders as $order)
    <?php
        $user = $order->member->user;
        $quotation = $order->quotation;
        $company = $quotation->company;
        $local = $quotation->local;
        $member_name = $user->name.' '.$user->lastname;
        $detail = $order->detail->map(function ($item, $key) {
            return $item->item_name;
        });
        $item_name = $detail->implode(', ');
        $params = '?page='.$page;
    ?>
    <tr>
        <td>{{ $order->created_at }}</td>
        <td><a href="{{ url('/admin/local?company_id='.$company->id) }}">{{ $company->name }} / {{ $local->name }}</a></td>
        <td>{{ $member_name }}</td>
        <td>{{ $item_name }}</td>
        <td class="text-right">S/ {{ $order->total }}</td>
        <td class="text-center"><span class="label label-{{ order_status_color($order->status) }}">{{ $status_list[$order->status] }}</span></td>
        <td>
        <a href="{{ route('order.show', $order) }}" class="btn btn-primary btn-xs">
            <i class="glyphicon glyphicon-search"></i> Detalles
        </a>
        </td>
    </tr>
    @endforeach
    </table>
    {!! $orders->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-warning" role="button" href="{{ url('/admin/order') }}{{ $module_params }}?export=true">
    <span class="fa fa-download"></span> descargar </a>
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
