<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

$site = App\Models\CmsSite::where('default', true)->first();

$site_header_js = get_field($site->metadata, 'header_js');
$site_body_js = get_field($site->metadata, 'body_js');
$site_footer_js = get_field($site->metadata, 'footer_js');

$ubigeo = isset($_COOKIE['ubigeo'])? $_COOKIE['ubigeo']: env('DEFAULT_UBG');

$conf_analytics = \App\Models\CmsConfig::where('alias', 'analytics')->first()->value;
$wrapper ='wrapper '. ($page->front_view=='seccion_home'? 'wrapper_home': 'wrapper_interna');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  @yield('meta_tag')
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css" media="screen">

  <script type="text/javascript">
    var URL_ROOT='{{ $url_root }}';
  </script>
@yield('header_js')
@yield('payment_js')
{!! $site_header_js !!}
</head>
<body>
  @yield('payment_form')
{!! $site_body_js !!}
  <div id="loader"></div>
  <div class="{{ $wrapper }}">  
    <header id="header">
      @include('front.partials.header')
    </header>
    <div class="sombra_de_menu"></div>
    @yield('content')
    <footer>
      @include('front.partials.footer')
    </footer>
  </div>
@yield('layers')
@yield('footer_js')
{!! $site_footer_js !!}
</body>
</html>