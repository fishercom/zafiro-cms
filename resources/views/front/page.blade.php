@extends('layouts.front')
<?php

$url_root= url('/');
$url_base= $url_root;

switch(explode('.', $page->route_view)[1]){
	case 'company':
		$banner_top = 'front.company.partials.banner_top';
		break;
	case 'product':
		$banner_top = 'front.product.partials.banner_top';
		break;
	default:
		$banner_top = 'front.partials.banner_top';
		break;
}

?>
@section('content')
	<section>
		@include($banner_top)

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
