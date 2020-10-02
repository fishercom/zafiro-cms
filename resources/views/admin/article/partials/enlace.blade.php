<?php
$types=array('0'=>'Sin enlace', '1'=>'Enlace Interno', '2'=>'Enlace Extero');
$targets=array('1'=>'Misma Ventana', '2'=>'Nueva Ventana');

$list=\App\CmsArticle::has('page_schemas')->with('page_schemas')
  ->where('active', '1')
  ->select('id', 'parent_id', 'title')
  ->orderBy('schema_id', 'asc')
  ->orderBy('position', 'asc')
  ->get();

?>
<div class="form-group">
  {!! Form::label('ref_type', 'Enlace', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
  <div class="col-sm-4 col-lg-2">
    <div class="input-group">
      {!! Form::select('ref_type', $types, null, ['class'=>'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-5 col-lg-8" id="pick_target">
    <div class="input-group">
      {!! Form::select('ref_target', $targets, null, ['class'=>'form-control']) !!}
    </div>
  </div>
</div>
<div id="ref_internal" class="form-group">
  <div class="col-sm-9 col-md-10 col-lg-11 col-sm-offset-3 col-lg-offset-1">
    <select name="ref_id" id="ref_id" class="form-control">
      <option value="0">Seleccionar enlace:</option>
      @foreach($list as $obj)
      <?php
        $titles=array();
        $pobj =$obj;
        while($pobj!=NULL){
          $titles[]=$pobj->title;
          $pobj=$pobj->parent;
        }
        krsort($titles);
        $title=implode('/', $titles);
      ?>
        <option value="{{ $obj->id }}" <?php if($article->ref_id==$obj->id) echo "selected"; ?>>{{ $title }}</option>
      @endforeach
    </select>
  </div>
</div>
<div id="ref_external" class="form-group">
  <div class="col-sm-9 col-md-10 col-lg-11 col-sm-offset-3 col-lg-offset-1">
      {!! Form::text('ref_url', null, ['class'=>'form-control', 'placeholder'=>'http://']) !!}
  </div>
</div>

<script type="text/javascript">
function showCtl_Options(opt){
  $('#ref_target').show();
  switch(opt){
    case '0':
      $('#ref_target').hide();
      $('#ref_internal').hide();
      $('#ref_external').hide();
      break;
    case '1':
      $('#ref_internal').show();
      $('#ref_external').hide();
      break;
    case '2':
      $('#ref_internal').hide();
      $('#ref_external').show();
      break;
  }
}
$(document).ready(function(){
  $('#ref_internal').hide();
  $('#ref_external').hide();
  
  $('#ref_type').change(function(){
    showCtl_Options($('#ref_type').val());
  });
  
  showCtl_Options($('#ref_type').val());
});
</script>