<?php

$metadata=$member->metadata;
$user_photo = get_field($metadata, 'photo');
$user_photo = !empty($user_photo)? get_userfiles($user_photo): null;

$department_list = get_department_pluck();
$province_list = get_province_pluck($member->department_id);
$district_list = get_district_pluck($member->department_id, $member->province_id);

$doctype_list = Config::get('constants.document_type');
$status_list = Config::get('constants.member_status');
?>
<div class="box-body">

	<div class="col-sm-12 col-md-5 pull-right">
		<div class="form-group">
			<div align="center">
			{!! Form::hidden('metadata[photo]') !!}
			<input type="file" name="metadata[upload]" id="metadata_photo" class="dropify" data-allowed-file-extensions="jpg png" data-height="238" data-default-file="{{ $user_photo }}"/>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-7 pull-left">
		<div class="form-group">
			{!! Form::label('name', 'Nombres', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('name', 'Apellidos', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('lastname', $user->lastname, ['class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email', 'Email', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
			</div>
		</div>

@if(!$member->user)
	<div class="form-group">
		{!! Form::label('password', 'Contraseña', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::password('password', ['class'=>'form-control', 'autocomplete' => 'off']) !!}
		</div>
	</div>
@endif

		<div class="form-group">
			{!! Form::label('phone', 'Teléfono', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::number('phone', null, ['class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('document_type', 'Tipo de Documento', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('document_type', $doctype_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('document', 'Nro. de Documento', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::number('document', null, ['class'=>'form-control']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('department_id', 'Departamento', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('department_id', $department_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('province_id', 'Provincia', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('province_id', $province_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('district_id', 'Distrito', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('district_id', $district_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('address', 'Dirección', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('address', null, ['class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('reference', 'Referencia', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('reference', null, ['class'=>'form-control']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('postal', 'Código Postal', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('postal', null, ['class'=>'form-control']) !!}
			</div>
		</div>


		<div class="form-group" style="display: none;">
			{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
				<label>{!! Form::checkbox('sendmail', '1') !!} Notificar por mail</label>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('status', 'Estado', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('status', $status_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
			</div>
		</div>

	</div>
</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('member.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>

<script type="text/javascript">
$(function(){
	var department = $('select[name=department_id]');
	var province = $('select[name=province_id]');
	var district = $('select[name=district_id]');

	$('#post_form').attr('enctype', 'multipart/form-data');

	$('.dropify').dropify({
		messages: {
			'default': '{{ 'Cargar foto de perfil' }}',
			'replace': '{{ 'Remplazar foto de perfil' }}',
			'remove':  '{{ 'Eliminar' }}'
		}
	});

    department.change(function(e){
    	var url = '/api/ubigeo/province/'+$(this).val()+'/list';
        $.ajax({
        	url : url,
            success : function(data){
                province.html("<option value=''></option>");
                district.html("<option value=''></option>");
                $.each(data, function (id, name){
                    province.append($("<option />").val(id).text(name));
                });
            }
        });
    });

    province.change(function(e){
    	var url = '/api/ubigeo/district/'+department.val()+'/'+$(this).val()+'/list';
        $.ajax({
        	url : url,
            success : function(data){
                district.html("<option value=''></option>");
                $.each(data, function (id, name){
                    district.append($("<option />").val(id).text(name));
                });
            }
        });
    });

});
</script>
@section('custom_header')
	<link href="{{ asset('/assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/assets/plugins/image-uploader/dist/image-uploader.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/assets/plugins/dropify/js/dropify.min.js') }}"></script>
	<script src="{{ asset('/assets/plugins/image-uploader/dist/image-uploader.min.js') }}"></script>
@endsection
