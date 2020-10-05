<?php

$conf_analytics = \App\CmsConfig::where('alias', 'analytics')->first()->value;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  @yield('meta_tag')
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/assets/sites/css/main.css') }}" media="screen">
  <link rel="stylesheet" href="{{ asset('/assets/sites/css/bootstrap.min.css') }}" media="screen">
  <script src="{{ asset('/assets/sites/js/jquery-1.11.3.min.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/libs/loader/Pxloader.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/libs/loader/PxloaderImage.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/jquery.jqtransform.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/TweenMax.min.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/jquery.bxslider.min.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/assets/sites/js/funciones.js') }}"></script>
  <script type="text/javascript">
    var URL_ROOT='{{ url('/') }}';
    var LANG_ID='{{ $lang->id }}';
  </script>
@yield('header_js')
</head>
<body>  
  <div id="loader"></div>
  <div class="fondo"></div>
  <div class="wrapper wrapper_home">
    <header id="header">
      @include('sites.partials.header')
    </header>
    <div class="sombra_de_menu"></div>    
    @include('sites.partials.error_handler')
    @yield('content')
    <footer>
      @include('sites.partials.footer')
    </footer>
  </div>
@yield('layers')
<style type="text/css">
button { text-align: left!important; padding: 0px 15px!important; margin: 0px!important; border: 0px; }
</style>
<script type="text/javascript" src="{{ asset('/js/forms.js') }}"></script>
<script type="text/javascript">
  var trans_categoria = '{{ $trans_categoria }}';
</script>
{!! $conf_analytics !!}
</body>
</html>
