<?php

use App\CmsParameterGroup;

$group = CmsParameterGroup::find($group_id);

$metadata = $parameter->metadata;
?>
<div class="box-body">
	<div class="form-group">
		{!! Form::label('null', 'Nombre', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
		{!! Form::text('name', null, ['class'=>'form-control', 'required'=>true]) !!}
		</div>
	</div>
@if( $group->alias =='dashboard' )
	@include('admin.parameter.templates.dashboard')
@endif
	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-2 control-label']) !!}
		<div class="col-sm-9 col-lg-10">
			<label>{!! Form::checkbox('active', '1', $parameter->active) !!}Activo</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('parameter.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#color_param').css('background-color', $('#color_param').val());
	$('#color_param').blur(function(event) {
		$('#color_param').css('background-color', $('#color_param').val());
	});
  $('.fmanager').each(function(idx, item){
    var rel=$(item).attr('rel');
    var id=$(item).attr('id');
    var btn=$('<span class="input-group-btn"><button class="btn btn-info btn-flat" type="button"><i class="fa fa-camera"></i></button></span>');
    var pnl=$('<div class="fpanel"><iframe width="100%" height="400" frameborder="0" src="{{ asset('/assets/plugins/filemanager/dialog.php') }}?type=2&field_id='+id+'&relative_url=1&fldr='+rel+'&akey=aZc1edG8c65d3"></iframe></div>');
    $(this).parent().append(btn);
    $(this).parent().parent().append(pnl);
    $(btn).click(function(){
      $(pnl).toggle();
    });
  });
  $(".fpanel").hide();
});
</script>