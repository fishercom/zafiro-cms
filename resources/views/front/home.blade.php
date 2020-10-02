@extends('layouts.front')
<?php

$url_root= url('/');
$url_base= $url_root;

$page_schema=$page->schema;

$bloque_animacion=$page->child_template('bloque_animacion')->first();

?>
@section('content')
    <section>

    @if($bloque_animacion)
      @include('front.partials.home.bloque_animacion')
    @endif

      <div class="seccion_principal">

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
