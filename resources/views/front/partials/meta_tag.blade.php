<?php

$metas_title = ($page->front_view=='home_page')? $site->name: $page->title.' - '.$site->name;
$metas_descr = get_field($page->metadata, 'meta_description');
$metas_keywr = get_field($page->metadata, 'meta_keywords');
$metas_robot = get_field($page->metadata, 'meta_robots');
$metas_image = get_field($page->metadata, 'meta_image');
$metas_url	 = url_article($page);

?>
	<title>{{ $metas_title }}</title>
	<meta name="description" content="{{ $metas_descr }}">
	<meta name="keywords" content="{{ $metas_keywr }}">
	<meta name="robots" content="{{ $metas_robot }}" />
	<meta property="og:title" content="{{ $metas_title }}" />
	<meta property="og:type" content="article" />
@if(!empty($metas_image))
	<meta property="og:image" content="{{ url('userfiles/'.$metas_image) }}" />
@endif
	<meta property="og:url" content="{{ $metas_url }}" /> 
