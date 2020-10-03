<?php
use Carbon\Carbon;

$member = $order->member;
$quotation = $order->quotation;

$user = $order->member->user;
$order_name = $user->name.' '.$user->lastname; 

$member_photo = get_userfiles(get_field($member->metadata, 'photo'));

$status_list = Config::get('constants.order_status');
$detail = $order->detail;
$payment = $order->payment? $order->payment: new App\OrderPayment;

?>
@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> {{ $current_module->title }}: {{$order->id}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	<div class="box-body">
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom" style="box-shadow: inherit;">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Detalle de la Orden</a></li>
				<li><a href="#tab_2" data-toggle="tab">Datos de la Transacción</a></li>
			</ul>

			<div class="tab-content">

			<div class="tab-pane active" id="tab_1">
			  <div class="box-body">

				<div class="col-sm-2 col-md-4 pull-right">
					@if(!empty($member_photo))
					<div class="form-group">
						<div align="center">
							<img src="{{ $member_photo }}" style="width: 250px;" class="img-thumbnail">
						</div>
					</div>
					@endif
					<div class="card">
						<div class="card-body">
							<p align="center">Estado: <span class="label label-{{ order_status_color($order->status) }}">{{ $status_list[$order->status] }}</span></p>
						</div>
					</div>
				</div>
				<div class="col-sm-10 col-md-8 pull-left">
					<div class="form-group">
						{!! Form::label('name', 'Fecha', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $user->created_at }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('country_id', 'Empresa', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $quotation->company->name }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('country_id', 'Local', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $quotation->local->name }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('lastname', 'Cliente', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $user->name }} {{ $user->lastname }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('email', 'E-mail', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $user->email }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('phone', 'Celular', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $member->phone }}</div>
					</div>
				@if($member->company)
					<div class="form-group">
						{!! Form::label('company', 'Empresa', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $member->company->name }}</div>
					</div>
				@endif
					<div class="form-group">
						{!! Form::label('total', 'Monto Total', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">S/{{ $order->total }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('comments', 'Comentarios', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $order->comments }}</div>
					</div>
				</div>

			  <div class="col-sm-12 col-lg-12">
				<div class="form-group row">

					<div class="col-sm-12 col-lg-12">
						<h4>Detalle de la Orden</h4>
						<table class="table table-bordered table-hover">
						<tr>
							<th class="col-sm-6">Item</th>
							<th class="col-sm-2">Precio</th>
							<th class="col-sm-2">Cantidad</th>
							<th class="col-sm-2">Subtotal</th>
						</tr>
						@foreach ($detail as $item)
						<tr>
							<td>{{ $item->item_name }}</td>
							<td class="text-right">S/{{ $item->price }}</td>
							<td class="text-center">{{ $item->quantity }}</td>
							<td class="text-right">S/{{ $item->subtotal }}</td>
						</tr>
						@endforeach
						</table>

					</div>
				</div>
			  </div>
			  </div>
			</div>

			<div class="tab-pane" id="tab_2">
			  <div class="box-body">

					<div class="form-group">
						{!! Form::label('purchaseOperationNumber', 'purchaseOperationNumber', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->purchaseOperationNumber }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('purchaseAmount', 'purchaseAmount', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->purchaseAmount }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('purchaseCurrencyCode', 'purchaseCurrencyCode', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->purchaseCurrencyCode }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('descriptionProducts', 'descriptionProducts', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->descriptionProducts }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('authorizationResult', 'authorizationResult', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->authorizationResult }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('authorizationCode', 'authorizationCode', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->authorizationCode }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('errorCode', 'errorCode', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->errorCode }}</div>
					</div>
					<div class="form-group">
						{!! Form::label('errorMessage', 'errorMessage', ['class'=>'col-sm-6 col-md-5 control-label']) !!}
						<div class="form-control">{{ $payment->errorMessage }}</div>
					</div>

			  </div>
			</div>

		</div>
	</div>
</div>

<div class="box-footer">
	<a href="{{ route('order.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> regresar </a>
</div>

<style>
.red{ color: red; }	
.green{ color: green; }	
</style>

</div>
@endsection
