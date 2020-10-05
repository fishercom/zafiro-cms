@extends('layouts.sites')
<?php
use \App\Util\SEO;

$metas_title = $page->title.' - '.$site->name;
$metas_descr = get_field($page->metas, 'description');
$metas_keywr = get_field($page->metas, 'keywords');
$metas_robot = get_field($page->metas, 'robots');
$metas_image = get_field($page->metas, 'image');
$metas_url	 = \App\Util\SEO::url_article($page);
$lang_id = $page->lang_id;
$url_root= url('/');

$formType = Request::input('formType');
$ticket = Request::input('ticket');

$schema=$page->schema;
$front_view = 'sites.templates.'.$schema->front_view;

$seccion_home = 
\App\CmsArticle::whereHas('schemas', function ($query) {
	$query->where('front_view', 'seccion_home');
})
->where('lang_id', $lang_id)
->whereNull('parent_id')
->first();

$form_denuncia = $seccion_home->find_template('form_denuncia')->first();

$trans_categoria = transl('Por Categoría');
?>
@section('content')

	@if(View::exists($front_view))
		@include($front_view)
	@else
		@include('sites.partials.missing_template')
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
<link href="{{ asset('/js/jquery.validate/jquery.validate.css') }}"rel="stylesheet"/>
<script src='{{ asset('/js/jquery.validate/jquery.validate.js') }}'></script>
@if($lang_id==1)
<script src='{{ asset('/js/jquery.validate/localization/messages_es_PE.min.js') }}'></script>
@endif
<script src='https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_PUBLIC') }}'></script>
<script>
var recaptchaPublickey = '{{ env('GOOGLE_RECAPTCHA_PUBLIC') }}';
//grecaptcha.ready(function () {
//    recaptchaReset();
//});
</script>
@endsection
