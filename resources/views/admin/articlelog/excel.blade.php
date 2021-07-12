<?php

function HeaderSlide($slide){

    switch ($slide->schema->front_view){
        case 'slide_gestion':
        case 'slide_manuales':
        case 'slide_documentos':
            $title = 'Acepto los términos para la descarga de ' . $slide->title; //. '</th><th>'.
            //'Ha realizado la descarga de ' . $slide->title;
            break;
        case 'slide_fotografia':
            $title = 'Ha cargado su fotografía';
            break;
        case 'slide_cita':
            $title = 'Ha confirmado su cita';
            break;
        default:
            $title = $slide->title;
            break;
    }

    return $title;
}

function DetailSlide($slide, $user){

    switch ($slide->schema->front_view){
        case 'slide_gestion':
        case 'slide_manuales':
        case 'slide_documentos':
            $title = 'Yo, '.$user->name.', he aceptado los términos y he descargado ' . $slide->title; //. '</td><td>'.
            //$title = 'Yo, '.$user->name.', descargué los archivos de ' . $slide->title;
            break;
        case 'slide_fotografia':
            $title = 'Yo, '.$user->name.', he cargado mi fotografía';
            break;
        case 'slide_cita':
            $title = 'Yo, '.$user->name.', he confirmado mi cita';
            break;
        default:
            $title = $slide->title;
            break;
    }

    return $title;
}

$page = \App\Models\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'segmento');
})
->where(\DB::raw("ExtractValue(param, '/root/item[@key = \"worker\"]/@value')"), $worker)
->whereNull('parent_id')
->where('active', '1')
->first();

$bloques = $page->children;

$slides = \App\Models\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'slide_manuales');
    $query->orWhere('front_view', 'slide_gestion');
    $query->orWhere('front_view', 'slide_documentos');
    $query->orWhere('front_view', 'slide_fotografia');
    $query->orWhere('front_view', 'slide_cita');
})
->whereIn('parent_id', $bloques->pluck('id'))
->get();
?>
<table>
<tr>
    <th>Fecha de Registro</th>
    <th>Nombre</th>
    <th>Email</th>
@foreach ($slides as $slide)
    <th>{!! HeaderSlide($slide) !!}</th>
@endforeach
    <th>Fecha de Cita</th>
    <th>Foto</th>
</tr>
@foreach ($users as $user)
<?php
$photo=!empty($user->photo)? '<a href="'.asset('/userfiles/user/avatar/'.$user->photo).'">descargar</a>': NULL;
?>
<tr>
    <td>{{ $user->created_at }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
@foreach ($slides as $slide)
<?php
$log = \App\Models\CmsArticleLog::where('article_id', $slide->id)->where('user_id', $user->id)->first();
$check = $log? DetailSlide($slide, $user): NULL;
?>
    <td>{!! $check !!}</td>
@endforeach
    <td>{{ $user->meeting }}</td>
    <td>{!! $photo !!}</td>
</tr>
@endforeach
</table>
