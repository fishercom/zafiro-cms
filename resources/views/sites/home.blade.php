@extends('layouts.sites')
<?php
use \App\Util\SEO;

$metas_title = $site->name;
$metas_descr = get_field($page->metas, 'description');
$metas_keywr = get_field($page->metas, 'keywords');
$metas_robot = get_field($page->metas, 'robots');
$metas_image = get_field($page->metas, 'image');
$metas_url	 = SEO::url_article($page);

$lang_id = $page->lang_id;
$url_root= url('/');

$bloque_animacion=$page->child_template('bloque_animacion')->first();
$bloque_widget=$page->child_template('bloque_widget')->first();

$trans_categoria = transl('Por Categoría');
?>
@section('content')
    <section>

	@if($bloque_animacion)
		@include('sites.partials.home.bloque_animacion')
	@endif

@endsection

@section('layers')
	@include('sites.partials.layers')
@endsection

@section('meta_tag')
	<title>{{ $metas_title }}</title>
	<meta name="description" content="{{ $metas_descr }}">
	<meta name="keywords" content="{{ $metas_keywr }}">
	<meta name="robots" content="{{ $metas_robot }}" />
	<meta property="og:title" content="{{ $metas_title }}" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="{{ url('userfiles/'.$metas_image) }}" />
	<meta property="og:url" content="{{ $metas_url }}" /> 
@endsection

@section('header_js')
<script src='https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_PUBLIC') }}'></script>
<script>
var recaptchaPublickey = '{{ env('GOOGLE_RECAPTCHA_PUBLIC') }}';
</script>
@endsection
