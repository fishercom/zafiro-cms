@extends('layouts.layer')
<?php

$schema=$page->schema;
$front_view = 'front.templates.'.$schema->front_view;

?>
@section('content')
	@if(View::exists($front_view))
		@include($front_view)
	@else
		@include('front.partials.missing_template')
	@endif
@endsection