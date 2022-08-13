<?php

use \App\Models\CmsDirectory;

$photo= isset($user) ? get_field($user->metadata, 'photo'): null;
$directory=CmsDirectory::select()->where('alias', 'user_photo')->first()->path;

$profiles=\App\Models\Profile::select()
//	->whereNull('default')
	->where('id', '<>', '1')
	->where('active', true)
	->pluck('name', 'id');

?>
<div class="box-body">

	<div class="form-group">
		{!! Form::label('name', 'Nombres', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('name', 'Apellidos', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('lastname', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('email', null, ['class'=>'form-control']) !!}
		</div>
	</div>

@if(!isset($user))
	<div class="form-group">
		{!! Form::label('password', 'Contraseña', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::password('password', ['class'=>'form-control', 'autocomplete' => 'off']) !!}
		</div>
	</div>
@endif

	<div class="form-group">
	  {!! Form::label('metadata[photo]', 'Foto', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('metadata[photo]', null, ['class'=>'form-control fmanager', 'id'=>'photo', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
		{!! Form::label('profile_id', 'Perfil de Usuario', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		@if(!isset($user) || !$user->default)
			{!! Form::select('profile_id', $profiles, null, ['class'=>'form-control']) !!}
		@else
			{!! Form::hidden('profile_id') !!}
			{{ $user->profile->name }}
		@endif
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
			<label>
		{!! Form::checkbox('active', '1') !!}
		Activo
			</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('user.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>

<script type="text/javascript">
$(document).ready(function(){
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