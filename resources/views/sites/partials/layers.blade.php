<?php
$layers = 
\App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'layer_denuncia');
})
->where('lang_id', $lang->id)
->get();
?>
@if($layers)
<div class="content_fancy">
    <div class="equis_f"></div>
    @foreach($layers as $item)
    <div class="fancy" id="ffancy_{{ $item->id }}" style="display: none; font-size: 14px;">
        <div class="titulo">
            <img src="images/ico1f.png" alt="">
            <p class="tt">{{ $item->title }}</p>
        </div>
        <div class="parrafo">
            {!! $item->description !!}
        </div>
        <div class="btn_cerrar_f">
            {{ mb_strtoupper(transl('Cerrar')) }}
        </div>
    </div>
    @endforeach
</div>
@endif
