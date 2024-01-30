@extends('layouts.admin')
<?php
$params = '?schema_id='.$parent->schema_id.'&parent_id='.$parent->parent_id.'&lang_id='.$lang->id;
?>
@section('content')
<script type="text/javascript">
function Filter(sender){
    frm = sender.form;
    if(sender.name=='lang_id' || sender.name=='site_id'){
        frm['parent_id'].value='';
        frm['schema_id'].value='';
    }
    frm.submit();
}
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="callout callout-info visible-lg visible-md">
            <h4>Info</h4>
            <p>
                Seleccione un art&iacute;culo de la lista para editar su contenido o haga clic en el menu lateral para seleccionar otra secci&oacute;n.
                @if ($parent->id != NULL)
                <br />
                Si desea editar el contenido del nivel superior, haga <a href="{{ route('article.edit', $parent->id) }}{{ $params }}"><strong>clic aqu&iacute;</strong></a>.
                @endif
            </p>
        </div>
    </div>
</div>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> <?php echo $current_module->name; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'article.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('schema_id', $schema->id) !!}
    {!! Form::hidden('parent_id', $parent->id) !!}
    <div class="form-group">
        <div class="col-sm-2">
            {!! Form::select('lang_id', $langs, $lang->id, ['class'=>'form-control', 'onchange'=>'Filter(this)']) !!}
        </div>
        <div class="col-sm-4">
            {!! Form::select('site_id', $sites, $site->id, ['class'=>'form-control', 'onchange'=>'Filter(this)']) !!}
        </div>
        <div class="col-sm-4">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por t&iacute;tulo" />
        </div>
        <div class="col-sm-2">
          <button type="submit" id="btn_find" class="btn btn-success"><i class="fa fa-search"></i> buscar</button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-6">Título</th>
        <th class="col-sm-2 text-center">Fecha Registro</th>
        <th class="col-sm-2 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($articles_pg as $article)
    <?php
        if(\App\Models\CmsSchema::select()->where('parent_id', $article->schema_id)->first()!=NULL)
            $title = '<a href="'.url('admin/article').'?parent_id='.$article->id.'&site_id='.$article->site_id.'&schema_id='.$article->schema_id."\">$article->title</a>";
        else
            $title = $article->title;

        $active = $article->active? '<i class="fa fa-check"></i>' : NULL;
        $params = '?schema_id='.$article->schema_id.'&site_id='.$article->site_id.'&parent_id='.$article->parent_id.'&lang_id='.$article->lang_id.'&page='.$page;
    ?>
    <tr>
        <td>{!! $title !!}</td>
        <td class="text-center">{{ $article->created_at }}</td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('article.edit', $article->id) }}{{ $params }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$article->id, 'method'=>'DELETE', 'route' => array('article.destroy', $article->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('parent_id', $parent->id) !!}
            {!! Form::hidden('page', $page) !!}
        <label data-form="#frm_del-{{$article->id}}" data-title="Eliminar Contenido" data-message="¿Esta seguro que desea eliminar <strong>'{{ $article->title }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $articles_pg->render() !!}
  </div>
  <div class="box-footer">
<?php
$cntsch= count($schemas);
$cntart= count($articles);
$iterat= $cntsch>0 ? $schemas[0]->iterations: 0;
if($cntsch>1 || ($cntsch==1 && $iterat>0 && $iterat==$cntart)){
?>
    <a id="btn_new" class="btn btn-success" role="button" data-toggle="modal" data-target="#mod_schema">
    <i class="fa fa-plus"></i> nuevo Contenido </a>
<?php
}
else{
    if($cntsch==1){
    $params = '?schema_id='.$schemas[0]->id.'&parent_id='.$parent->id.'&site_id='.$site->id.'&lang_id='.$lang->id.'&page='.$page;
?>
    <a class="btn btn-success" role="button" href="{{ route('article.create') }}{{ $params }}">
    <i class="fa fa-plus"></i> nuevo contenido </a>
<?php
    }
}
?>
    <button type="button" id="btn_sort" class="btn btn-warning" data-toggle="modal" data-target="#sort_modal"><i class="fa fa-sort"></i> ordenar</button>

@if ($parent->id != NULL)
<?php
    $params = '?schema_id='.$parent->schema_id.'&parent_id='.$parent->parent_id.'&site_id='.$site->id.'&lang_id='.$lang->id;
?>
    <a class="btn btn-danger" role="button" href="{{ route('article.index') }}{{ $params }}">
    <i class="fa fa-arrow-left"></i> Regresar </a>
@endif
  </div>
</div>

<!-- Modal Dialog -->
@include('admin.article.partials.schema_list')
@include('admin.article.partials.sort_list')
@include('admin.partials.delete_confirm')

@endsection

