<?php

$metadata=$company->metadata;
$metadata_logo = get_field($metadata, 'logo');
$metadata_logo = !empty($metadata_logo)? get_userfiles($metadata_logo): null;

$doctype_list = Config::get('constants.document_type');
$acctype_list = Config::get('constants.account_type');

$status_list = Config::get('constants.company_status');
?>
<div class="box-body">

	<!-- Custom Tabs -->
	<div class="nav-tabs-custom" style="box-shadow: inherit;">
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab_1" data-toggle="tab">Ficha de la Empresa</a></li>
	    <li><a href="#tab_2" data-toggle="tab">Representante Legal</a></li>
	    <li><a href="#tab_3" data-toggle="tab">Información Bancaria</a></li>
	  </ul>
	  <div class="tab-content">

		<div class="tab-pane active" id="tab_1">
		  <div class="box-body">
			<div class="col-sm-12 col-md-5 pull-right">
				<div class="form-group">
					<div align="center">
					{!! Form::hidden('metadata[logo]') !!}
					<input type="file" name="metadata[upload]" id="metadata_logo" class="dropify" data-allowed-file-extensions="jpg jpeg png" data-height="238" data-default-file="{{ $metadata_logo }}"/>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-7 pull-left">
				<div class="form-group">
					{!! Form::label('name', 'Razón Social', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('ruc', 'RUC', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('ruc', null, ['class'=>'form-control', 'max'=>'99999999999']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
					</div>
				</div>

		@if(!$company->member)
			<div class="form-group">
				{!! Form::label('password', 'Contraseña', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
				<div class="col-sm-9 col-lg-10">
				{!! Form::password('password', ['class'=>'form-control', 'autocomplete' => 'off']) !!}
				</div>
			</div>
		@endif

				<div class="form-group">
					{!! Form::label('phone_1', 'Teléfono 1', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('phone_1', null, ['class'=>'form-control', 'max'=>'999999999']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('phone_2', 'Teléfono 2', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('phone_2', null, ['class'=>'form-control', 'max'=>'999999999']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('website', 'Sitio Web', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::url('website', null, ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group" style="display: none;">
					{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
						<label>{!! Form::checkbox('sendmail', '1') !!} Notificar por mail</label>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('status_id', 'Estado', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::select('status_id', $status_list, null, ['class'=>'form-control']) !!}
					</div>
				</div>

			</div>
		  </div>
		</div>

		<div class="tab-pane" id="tab_2">
		  <div class="box-body">

				<div class="form-group">
					{!! Form::label('user[name]', 'Nombre', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('user[name]', $user->name, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('user[lastname]', 'Apellidos', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('user[lastname]', $user->lastname, ['class'=>'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('member[phone]', 'Teléfono', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('member[phone]', $member->phone, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('member[document_type]', 'Tipo de Documento', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::select('member[document_type]', $doctype_list, $member->document_type, ['placeholder'=>'', 'class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('member[document]', 'Nro. de Documento', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('member[document]', $member->document, ['class'=>'form-control']) !!}
					</div>
				</div>

		  </div>
		</div>

		<div class="tab-pane" id="tab_3">
		  <div class="box-body">

				<div class="form-group">
					{!! Form::label('billingdata[account_type]', 'Tipo de Cuenta', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::select('billingdata[account_type]', $acctype_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('billingdata[account]', 'Nro. de Cuenta', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::number('billingdata[account]', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('billingdata[document_type]', 'Tipo de Documento', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::select('billingdata[document_type]', $doctype_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('billingdata[document]', 'Nro. de  Documento', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::number('billingdata[document]', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('billingdata[account_owner]', 'Titular de Cuenta', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::text('billingdata[account_owner]', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('billingdata[account_cci]', 'Nro. CCI', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::number('billingdata[account_cci]', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('billingdata[comments]', 'Observaciones', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::textarea('billingdata[comments]', null, ['class'=>'form-control', 'rows'=>'4', 'maxlength'=>'512']) !!}
					</div>
				</div>
		  </div>
		</div>

	  </div>
	</div>
</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('company.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>

<script type="text/javascript">
$(function(){
	$('#post_form').attr('enctype', 'multipart/form-data');

	$('.dropify').dropify({
		messages: {
			'default': '{{ 'Cargar logo de la empresa' }}',
			'replace': '{{ 'Remplazar logo de la empresa' }}',
			'remove':  '{{ 'Eliminar' }}'
		}
	});
});
</script>

@section('custom_header')
	<link href="{{ asset('/assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/assets/plugins/image-uploader/dist/image-uploader.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/assets/plugins/dropify/js/dropify.min.js') }}"></script>
	<script src="{{ asset('/assets/plugins/image-uploader/dist/image-uploader.min.js') }}"></script>
@endsection
