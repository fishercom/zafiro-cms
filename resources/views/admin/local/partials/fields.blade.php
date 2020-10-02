<?php

$metadata=$local->metadata;
$metadata_photo = get_field($metadata, 'photo');
$metadata_photo = !empty($metadata_photo)? get_userfiles($metadata_photo): null;
$metadata_cover = get_field($metadata, 'cover');
$metadata_cover = !empty($metadata_cover)? get_userfiles($metadata_cover): null;

$metadata_zip = get_field($metadata, 'zip');

$company_list = \App\Company::select()->orderBy('name')->pluck('name', 'id');
$department_list = get_department_pluck();
$province_list = get_province_pluck($local->department_id);
$district_list = get_district_pluck($local->department_id, $local->province_id);
$discount_list = ['0'=>'', '5'=>'5%', '10'=>'10%', '15'=>'15%', '20'=>'20%', '25'=>'25%', '30'=>'30%', '35'=>'35%', '40'=>'40%', '45'=>'45%', '50'=>'50%', ];

$status_list = Config::get('constants.local_status');

$product_list = App\Product::where('active', true)->pluck('name', 'id');

$products = $local->inventories;
$offers = $local->offers;

if(count($offers)==0) $offers=[null];

?>
<div class="box-body">
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom" style="box-shadow: inherit;">
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab_1" data-toggle="tab">Información General</a></li>
	    <li><a href="#tab_3" data-toggle="tab">Ofertas</a></li>
	  </ul>
	  <div class="tab-content">

		<div class="tab-pane active" id="tab_1">
			<div class="col-sm-12 col-md-5 pull-right">
				<div class="form-group">
					<div align="center">
					{!! Form::hidden('metadata[photo]') !!}
					<input type="file" name="metadata[upload_photo]" id="dropify_photo" data-allowed-file-extensions="jpg jpeg png" data-height="200" data-min-width="259" data-default-file="{{ $metadata_photo }}"/>
					</div>
				</div>
				<div class="form-group">
					<div align="center">
					{!! Form::hidden('metadata[cover]') !!}
					<input type="file" name="metadata[upload_cover]" id="dropify_cover" data-allowed-file-extensions="jpg jpeg png" data-height="200" data-min-height="329" data-min-width="1098" data-default-file="{{ $metadata_cover }}"/>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-7 pull-left">
				<div class="form-group">
					{!! Form::label('company_id', 'Empresa', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
						{!! Form::select('company_id', $company_list, $local->company_id, ['placeholder'=>'Empresa', 'class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('name', 'Nombre del Local', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('phone_office', 'Teléfono Oficina', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('phone_office', null, ['class'=>'form-control', 'max'=>'999999999']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('phone_mobile', 'Teléfono Celular', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::number('phone_mobile', null, ['class'=>'form-control', 'max'=>'999999999']) !!}
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
					{!! Form::label('zip_code', 'Código Postal', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('zip_code', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('latitude', 'Latitud', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('latitude', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('longitude', 'Longitud', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
					{!! Form::text('longitude', null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
					<div class="col-sm-9 col-lg-10">
						<label>
					{!! Form::checkbox('active', '1') !!} Activo
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane" id="tab_3">
		  <div class="box-body">
			<div id="offer_container" class="col-sm-12 col-lg-12">
		@for($i = 0; $i < count($offers); $i++)
		<?php $offer=$offers[$i]; ?>
			  <div class="offer">
			  	{!! Form::hidden('offers['.$i.'][id]') !!}
				<div class="form-group col-sm-10 col-lg-7">
					{!! Form::label('offers['.$i.'][product_id]', 'Producto', ['class'=>'col-sm-4 col-lg-2 control-label']) !!}
					<div class="col-sm-8 col-lg-10">
					{!! Form::select('offers['.$i.'][product_id]', $product_list, null, ['placeholder'=>'', 'class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group col-sm-10 col-lg-3">
					{!! Form::label('offers['.$i.'][discount]', 'Descuento', ['class'=>'col-sm-4 col-lg-4 control-label']) !!}
					<div class="col-sm-8 col-lg-8">
					{!! Form::select('offers['.$i.'][discount]', $discount_list, null, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group col-sm-2 col-lg-2">
					<a href="#" class="delete"><span class="glyphicon glyphicon-minus"></span> Eliminar</a>
				</div>
			  </div>
		@endfor
			</div>
			<div class="form-group">
				<div class="col-sm-11 col-lg-11 col-sm-offset-1 col-lg-offset-1">
					<a href="#" id="add_more"><span class="glyphicon glyphicon-plus"></span> Añadir más Ofertas</a>
				</div>
			</div>
		  </div>
		</div>

	  </div>
	</div>
</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('local.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>

<script type="text/javascript">
$(function(){
	var department = $('select[name=department_id]');
	var province = $('select[name=province_id]');
	var district = $('select[name=district_id]');
	renderelm();

	$('#post_form').attr('enctype', 'multipart/form-data');

	$('#dropify_photo').dropify({
		messages: {
			'default': 'Cargar foto del local (260x230px)',
			'replace': 'Cambiar foto del local (260x230px)',
			'remove':  'Eliminar'
		}
	});
	$('#dropify_cover').dropify({
		messages: {
			'default': 'Cargar cover del local (1099x330px)',
			'replace': 'Cambiar cover del local (1099x330px)',
			'remove':  'Eliminar'
		}
	});

    $('#add_more').click(function(){
		var copies=$('.offer').length;
		var clone = $('.offer').eq(0).clone();
		clone.find('select,input').each(function() {
			this.name = this.name.replace('[0]', '['+copies+']');
			this.value ='';
		});
		clone.appendTo("#offer_container");
		renderelm();
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
function renderelm(){
    $('.offer .delete').click(function(){
    	if($('.offer').length==1) return;
		$(this).parent().parent().remove();
   	});
}

</script>

@section('custom_header')
	<link href="{{ asset('/assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/assets/plugins/image-uploader/dist/image-uploader.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/assets/plugins/dropify/js/dropify.min.js') }}"></script>
	<script src="{{ asset('/assets/plugins/image-uploader/dist/image-uploader.min.js') }}"></script>
@endsection
