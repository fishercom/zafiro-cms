<?php
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s',time()+60*60*8 ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

$site = App\CmsSite::where('default', true)->first();

$site_header_js = get_field($site->metadata, 'header_js');
$site_body_js = get_field($site->metadata, 'body_js');
$site_footer_js = get_field($site->metadata, 'footer_js');

$ubigeo = isset($_COOKIE['ubigeo'])? $_COOKIE['ubigeo']: env('DEFAULT_UBG');

$conf_analytics = \App\CmsConfig::where('alias', 'analytics')->first()->value;
$wrapper ='wrapper '. ($page->front_view=='seccion_home'? 'wrapper_home': 'wrapper_interna');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  @yield('meta_tag')
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="{{ asset('/') }}css/main.css" media="screen">
  <link rel="stylesheet" href="{{ asset('/') }}css/theme.css" media="screen">
  <link rel="stylesheet" href="{{ asset('/') }}css/pretty-checkbox.min.css">
  <livewire:styles />
  <script src="{{ asset('/') }}js/jquery-1.11.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script defer src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('maps.api_key') }}&libraries=places&v=weekly&callback=initMap"></script>
  <script src="{{ asset('/') }}js/bootstrap.min.js"></script>

  <link href="{{ asset('/') }}js/jquery.validate/jquery.validate.css"rel="stylesheet"/>
  <script src="{{ asset('/') }}js/jquery.validate/jquery.validate.js"></script>
  <script src="{{ asset('/') }}js/jquery.validate/localization/messages_es_PE.min.js"></script>

  <script src="{{ asset('/') }}js/libs/loader/Pxloader.js"></script>
  <script src="{{ asset('/') }}js/libs/loader/PxloaderImage.js"></script>
  <script src="{{ asset('/') }}js/jquery.jqtransform.js"></script>
  <script src="{{ asset('/') }}js/TweenMax.min.js"></script>
  <script src="{{ asset('/') }}js/jquery.bxslider.min.js"></script>
  <script src="{{ asset('/') }}js/owl.carousel.min.js"></script>
  <script src="{{ asset('/') }}js/funciones.js"></script>
  <script type="text/javascript">
    var URL_ROOT='{{ $url_root }}';
    var DEFAULT_LAT={{ env('DEFAULT_LAT') }};
    var DEFAULT_LNG={{ env('DEFAULT_LNG') }};
    var UBIGEO='{{ $ubigeo }}';
  </script>
@yield('header_js')
@yield('payment_js')
{!! $site_header_js !!}
</head>
<body>
  @yield('payment_form')
{!! $site_body_js !!}
  <div id="loader"></div>
  <div class="fondo"></div>
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
<script type="text/javascript" src="{{ asset('/js/forms.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/maps.js') }}"></script>
@yield('footer_js')
{!! $site_footer_js !!}
<livewire:scripts />
</body>
</html>