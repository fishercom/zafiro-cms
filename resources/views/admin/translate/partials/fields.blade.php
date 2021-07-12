<?php

use App\Models\CmsLang;

$langs = CmsLang::where('active', true)->get();

$metadata = $translate->metadata;

?>
<div class="box-body">

@foreach($langs as $lang)
	<div class="form-group">
		{!! Form::label('metadata['.$lang->iso.']', 'Nombre ['.$lang->name.']', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::text('metadata['.$lang->iso.']', null, ['class'=>'form-control', 'required'=>true]) !!}
		</div>
	</div>
@endforeach

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('translate.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
