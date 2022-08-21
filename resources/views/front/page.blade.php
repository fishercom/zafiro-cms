@extends('layouts.front')
<?php

$url_root= url('/');
$url_base= $url_root;

?>
@section('content')
	<section>
		<div class="seccion_principal">
			@if(View::exists($page->route_view))
				@include($page->route_view)
			@else
				@include('front.partials.missing_template')
			@endif
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
<script src='https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_PUBLIC') }}'></script>
<script>
var recaptchaPublickey = '{{ env('GOOGLE_RECAPTCHA_PUBLIC') }}';
</script>
@endsection
