@extends('layouts.front')
<?php

$url_root= url('/');
$url_base= $url_root;

$page_schema=$page->schema;

$bloque_animacion=$page->child_template('bloque_animacion')->first();
$bloque_widget=$page->child_template('bloque_widget')->first();

?>
@section('content')
    <section>

    @if($bloque_animacion)
      @include('front.partials.home.bloque_animacion')
    @endif

      <div class="seccion_principal">
        @include('front.product.partials.buscador')
        @include('front.partials.home.bloque_materiales')
        @include('front.company.partials.buscador')
        @include('front.partials.home.bloque_ferreterias')
        @include('front.partials.home.bloque_ofertas')
      </div>
    </section>
@endsection

@section('layers')
	@include('front.partials.layers')
@endsection

@section('meta_tag')

    @include('front.partials.meta_tag')
    
@endsection

@section('header_js')
@endsection
