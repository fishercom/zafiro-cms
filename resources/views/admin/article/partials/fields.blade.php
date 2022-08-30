<?php
$admin_view = 'admin.article.templates.'.$schema->admin_view;

$meta_descr = get_field($article->metadata, 'meta_description');
$meta_keywr = get_field($article->metadata, 'meta_keywords');
$meta_robot = get_field($article->metadata, 'meta_robots');
$meta_image = get_field($article->metadata, 'meta_image');

$metatag_dir = \App\Models\CmsDirectory::select()->where('alias', 'metatag_imagen')->first()->path;

?>
<script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  CKEDITOR.config.filebrowserBrowseUrl = "{!! asset('/assets/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc&akey=aZc1edG8c65d3') !!}";
  CKEDITOR.config.filebrowserUploadUrl = "{!! asset('/assets/plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc&akey=aZc1edG8c65d3') !!}";
  if($('textarea[name=resumen].ckeditor').length>0){
    CKEDITOR.replace( 'resumen',
		{
			toolbar : 'Basic',
			height:"100"
		});
  }
});
</script>
<div class="box-body">
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab">Contenido</a></li>
    <li><a href="#tab_2" data-toggle="tab">Meta-Tags</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1">

    <p class="text-info">template: {{ $schema->admin_view }} | {{ $schema->front_view }}</p>

		<div class="form-group">
			{!! Form::label('title', 'Título', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
			<div class="col-sm-9 col-lg-11">
			  {!! Form::text('title', null, ['class'=>'form-control']) !!}
			</div>
		</div>

    @if($schema->parent && $schema->parent->front_view=='seccion_content')
      @include('admin.article.partials.icono_menu')
    @endif

    @if(View::exists($admin_view))
      @include($admin_view)
    @else
      <p class="bg-danger">No se puede localizar la vista {{ $admin_view }}</p>
    @endif

		<div class="form-group">
			{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
			<label class="col-sm-9 col-lg-11">
			  {!! Form::checkbox('active', '1') !!}
				Activo
			</label>
		</div>
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
      
      <div class="form-group">
        {!! Form::label('metadata[meta_description]', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
        <div class="col-sm-9 col-lg-11">
          {!! Form::textarea('metadata[meta_description]', $meta_descr, ['class'=>'form-control']) !!}
          <div class="tagleyend">(*) Breve resumen de la p&aacute;gina</div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('metadata[meta_keywords]', 'Keywords', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
        <div class="col-sm-9 col-lg-11">
          {!! Form::text('metadata[meta_keywords]', $meta_keywr, ['class'=>'form-control']) !!}
          <div class="tagleyend">(*) Palabras relacionadas a la p&aacute;gina, separadas por comas</div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('metadata[meta_robots]', 'Robots', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
        <div class="col-sm-9 col-lg-11">
          {!! Form::text('metadata[meta_robots]', $meta_robot, ['class'=>'form-control']) !!}
          <div class="tagleyend">(*) index/noindex, follow/nofollow</div>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('metadata[meta_image]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
        <div class="col-sm-9 col-lg-11">
          <div class="input-group">
            {!! Form::text('metadata[meta_image]', $meta_image, ['class'=>'form-control fmanager', 'id'=>'meta_image', 'rel'=>$metatag_dir ]) !!}
          </div>
          <div class="tagleyend">(*) Imagen para compartir en redes sociales</div>
        </div>
      </div>
    @if(!empty($article->id))
      <div class="form-group">
        {!! Form::label('slug', 'Permalink', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
        <div class="col-sm-9 col-lg-11">
          {!! Form::text('slug', $article->slug, ['class'=>'form-control']) !!}
          <div class="tagleyend">(*) Nombre de ruta amigable, sin espacios ni caracteres especiales.</div>
        </div>
      </div>
    @endif

    </div>
        <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
</div>

<div class="box-footer">
  <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
  <a href="{{ route('article.index') }}{{ $module_params }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
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