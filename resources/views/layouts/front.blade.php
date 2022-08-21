<?php

$analytics = get_field($site->metadata, 'analytics');

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
</head>
<body>
  @yield('payment_form')
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
{!! $analytics !!}
</body>
</html>