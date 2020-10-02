<?php

$category_id = $product->category_id;
$subcategory_id = $product->subcategory_id;
$brand_id = $product->brand_id;
$unity_id = $product->unity_id;

$metadata = $product->metadata;
$photos = get_field($metadata, 'photos');
if(empty($photos)) $photos=[];

$category_list = parameter_pluck('category');
$subcategory_list = parameter_pluck('category', $category_id);
$brand_list = parameter_pluck('brand');
$unity_list = parameter_pluck('unity');

?>

<div class="box-body">

		<div class="form-group">
			{!! Form::label('name', 'Nombres', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::text('name', null, ['class'=>'form-control', 'required'=>true]) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('category_id', 'Categoría', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('category_id', $category_list, null, ['class'=>'form-control', 'placeholder'=>'Categoria del Producto', 'required'=>true]) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('subcategory_id', 'Subcategoría', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('subcategory_id', $subcategory_list, null, ['class'=>'form-control', 'placeholder'=>'Categoria del Producto']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('brand_id', 'Marca', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('brand_id', $brand_list, $brand_id, ['class'=>'form-control', 'placeholder'=>'Marca del Producto']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('unity_id', 'Unidad', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::select('unity_id', $unity_list, $unity_id, ['class'=>'form-control', 'placeholder'=>'Unidad de medida', 'required'=>true]) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('price', 'Precio Referencial', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::number('price', null, ['class'=>'form-control', 'required'=>true]) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('resumen', 'Resumen', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::textarea('resumen', null, ['class'=>'form-control', 'rows'=>'3']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
			{!! Form::textarea('description', null, ['class'=>'form-control ckeditor', 'rows'=>'5']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('photos', 'Fotos del Producto', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
				<div class="input-images" style="margin-bottom: 12px;"></div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
			<div class="col-sm-9 col-lg-10">
				<label>
			{!! Form::checkbox('active', '1') !!}
			Activo
				</label>
			</div>
		</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('product.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
<script type="text/javascript">
$(function(){

	let preloaded = [
	@for($i=0; $i<count($photos); $i++)
		{id: '{{ $photos[$i] }}', src: '{{ get_userfiles($photos[$i]) }}'},
	@endfor
	];

	$('.input-images').imageUploader({
		extensions: ['.jpg','.jpeg','.png'],
		mimes: ['image/jpeg','image/png'],
		maxSize: 2 * 1024 * 1024,
		maxFiles: 10,
		preloaded: preloaded,
		imagesInputName:'upload_photos',
		preloadedInputName:'metadata[photos]',
		label:'Cargar imágenes de productos'
	});

	$('#post_form').attr('enctype', 'multipart/form-data');

    $('select[name=category_id]').change(function(e){
    	var url = '/api/parameter/'+$(this).val()+'/list';
        $.ajax({
        	url : url,
            success : function(data){
            	var dd = $('select[name=subcategory_id]');
                dd.html("<option val=''>Subcategoria</option>");
                console.log(data);
                $.each(data, function (id, name){
                    dd.append($("<option />").val(id).text(name));
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
<script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  CKEDITOR.config.filebrowserBrowseUrl = "{!! asset('/assets/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc&akey=aZc1edG8c65d3') !!}";
  CKEDITOR.config.filebrowserUploadUrl = "{!! asset('/assets/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc&akey=aZc1edG8c65d3') !!}";
});
</script>
@endsection
