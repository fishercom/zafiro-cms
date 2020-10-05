@extends('layouts.sites')
<?php
use \App\Util\SEO;

$metas_title = $site->name;
$metas_descr = get_field($page->metas, 'description');
$metas_keywr = get_field($page->metas, 'keywords');
$metas_robot = get_field($page->metas, 'robots');
$metas_image = get_field($page->metas, 'image');
$metas_url	 = \App\Util\SEO::url_article($page);

$lang_id = $page->lang_id;
$url_root= url('/');
$parent_0=$page;

$bloque_animacion=$parent_0->child_template('bloque_animacion')->first();
$bloque_widget=$parent_0->child_template('bloque_widget')->first();

$trans_categoria = transl('Por Categoría');
?>
@section('content')
    <section>

	@if($bloque_animacion)
		@include('sites.partials.home.bloque_animacion')
	@endif


      <div class="seccion_principal">
        <div class="barra_buscador">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col_yellow">
                <div class="row padd-8">
                  <div class="col-md-4">
                    <div class="campo_select">
                      <select name="" id="">
                        <option value="">Por Categoría</option>
                        <option value="">Categoría 1</option>
                        <option value="">Categoría 2</option>
                        <option value="">Categoría 3</option>
                        <option value="">Categoría 4</option>
                        <option value="">Categoría 5</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="campo">
                      <input type="text" placeholder="Buscador de productos">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="btn_buscar">
                      Buscar                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col_red">
                <div class="box_registrate">
                  <a href="#" class="full"></a>
                  <div class="titulo">
                    Regístrate
                  </div>
                  <div class="texto">
                    Y forma parte de este gran evento
                  </div>

                  <div class="flecha"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="barra_quiero">
          <div class="container">
            <div class="row padd-0">
              <div class="col-md-4">
                <article>
                  <a href="#" class="full"></a>
                  <div class="titulo">
                    Quiero Comprar
                  </div>
                  <div class="texto">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  </div>
                  <div class="flecha"></div>
                  <div class="icono">
                    <img src="{{ asset('/assets/sites/images/grupo-99.svg') }}">
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article>
                  <a href="#" class="full"></a>
                  <div class="titulo">
                    Quiero Vender
                  </div>
                  <div class="texto">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  </div>
                  <div class="flecha"></div>
                  <div class="icono">
                    <img src="{{ asset('/assets/sites/images/grupo-102.svg') }}">
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article>
                  <a href="#" class="full"></a>
                  <div class="titulo">
                    Quiero Asistir
                  </div>
                  <div class="texto">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  </div>
                  <div class="flecha"></div>
                  <div class="icono">
                    <img src="{{ asset('/assets/sites/images/grupo-103.svg') }}">
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>

        <div class="seccion_productos_destacados">
          <div class="container">
            <h3>
              PRODUCTOS DESTACADOS
            </h3>
            <ul class="lista_productos_destacados">
              <li>
                <div class="row padd-0">
                  <div class="col-12">
                    <article class="especial">
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Perú
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-especial.jpg') }}">
                      </div>
                      <div class="titulo">
                        Cacao Peruano
                      </div>
                      <div class="texto">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit
                      </div>
                      <div class="mas"></div>
                      
                    </article>
                  </div>
                </div>                    
              </li>
              <li>
                <div class="row padd-0">
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Italia
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-1.jpg') }}">
                      </div>
                      <div class="titulo">
                        Tomates 
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Ecuador
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-2.jpg') }}">
                      </div>
                      <div class="titulo">
                        Pimientos
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Perú
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-3.jpg') }}">
                      </div>
                      <div class="titulo">
                        Carne de Pollo
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Argentina
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-4.jpg') }}">
                      </div>
                      <div class="titulo">
                        Carne de Res
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                </div>
              </li>
              <li>
                <div class="row padd-0">
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Perú
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-5.jpg') }}">
                      </div>
                      <div class="titulo">
                        Pepinos
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Perú
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-6.jpg') }}">
                      </div>
                      <div class="titulo">
                        Pan
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Perú
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-7.jpg') }}">
                      </div>
                      <div class="titulo">
                        Trucha
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                  <div class="col-6">
                    <article>
                      <a href="#" class="full"></a>
                      <div class="pais">
                        Colombia
                      </div>
                      <div class="star"></div>
                      <div class="imagen">
                        <img src="{{ asset('/assets/sites/images/home-productos-destacados-img-8.jpg') }}">
                      </div>
                      <div class="titulo">
                        Damascos
                      </div>
                      <div class="mas"></div>
                    </article>
                  </div>
                </div>
              </li>
            </ul>
          </div>

        </div>

        <div class="seccion_resultados">
          <div class="container">
            <div class="banner_resultados" style="background-image: url({{ asset('/assets/sites/images/banner-resultados.jpg') }});">
              <div class="yellow_box">
                <div class="titulo">
                  Resultados de la <br>Expo Alimentaria 2019
                </div>
                <div class="btn_ingrese">
                  <a href="#" target="_blank" class="full"></a>
                  Descarga el informe aquí
                  <div class="ico"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="seccion_proximos_eventos">
          <div class="container">
            <h3>
              Próximos Enventos
            </h3>

            <ul class="lista_proximos_eventos">         
              <li>
                <article>
                  <img src="{{ asset('/assets/sites/images/home-proximo-eventos-1.jpg') }}">
                  <div class="tit">
                    Expo Maracuyá
                  </div>
                  <div class="fecha">
                    Del 23 de Julio al 23 de Agosto
                  </div>
                  <div class="btn_masinfo">
                    <a href="#" class="full"></a>
                    Más Información
                  </div>
                </article>
              </li>
              <li>
                <article>
                  <img src="{{ asset('/assets/sites/images/home-proximo-eventos-2.jpg') }}">
                  <div class="tit">
                    EXPO CACAO
                  </div>
                  <div class="fecha">
                    Del 10 de Setiembre al 5 de Octubre
                  </div>
                  <div class="btn_masinfo">
                    <a href="#" class="full"></a>
                    Más Información
                  </div>
                </article>
              </li>
              <li>
                <article>
                  <img src="{{ asset('/assets/sites/images/home-proximo-eventos-3.jpg') }}">
                  <div class="tit">
                    Congreso del Pescador
                  </div>
                  <div class="fecha">
                    20 de Noviembre
                  </div>
                  <div class="btn_masinfo">
                    <a href="#" class="full"></a>
                    Más Información
                  </div>
                </article>
              </li>
              <li>
                <article>
                  <img src="{{ asset('/assets/sites/images/home-proximo-eventos-4.jpg') }}">
                  <div class="tit">
                    FEria Navideña Artesanal
                  </div>
                  <div class="fecha">
                    15 de Diciembre
                  </div>
                  <div class="btn_masinfo">
                    <a href="#" class="full"></a>
                    Más Información
                  </div>
                </article>
              </li>
            </ul>
          </div>
        </div>


        <div class="seccion_videos_testimoniales">
          <div class="container">
            <h3>
              VIDEOS TESTIMONIALES
            </h3>
            <div class="row padd-8">
              <div class="col-md-4">
                <article>
                  
                  <div class="imagen">
                    <a href="#" class="full"></a>
                    <img src="{{ asset('/assets/sites/images/home-video-1.jpg') }}">
                    <div class="velo"></div>
                    <div class="ico_play"></div>
                  </div>
                  <div class="titulo">
                    Titulo del Video
                  </div>
                  <div class="texto">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article>
                  
                  <div class="imagen">
                    <a href="#" class="full"></a>
                    <img src="{{ asset('/assets/sites/images/home-video-2.jpg') }}">
                    <div class="velo"></div>
                    <div class="ico_play"></div>
                  </div>
                  <div class="titulo">
                    Titulo del Video
                  </div>
                  <div class="texto">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article>
                  
                  <div class="imagen">
                    <a href="#" class="full"></a>
                    <img src="{{ asset('/assets/sites/images/home-video-3.jpg') }}">
                    <div class="velo"></div>
                    <div class="ico_play"></div>
                  </div>
                  <div class="titulo">
                    Titulo del Video
                  </div>
                  <div class="texto">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>

        <div class="seccion_publicidad">
          <div class="container">
            <div class="banner_publicidad" style="background-image: url({{ asset('/assets/sites/images/banner-publicidad.jpg') }});">
              <div class="yellow_box">
                <div class="titulo">
                  Publicidad
                </div>
                <div class="btn_ingrese">
                  <a href="#" target="_blank" class="full"></a>
                  Ingrese Aquí
                  <div class="ico"></div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="seccion_sponsors">
          <div class="container">
            <h3>
              Sponsors
            </h3>

            <ul class="lista_sponsors">
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-1.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-2.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-3.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-4.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-5.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-6.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-7.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-8.jpg') }}">
                </div>
              </li>
              <li>
                <div class="box_logo">
                  <img src="{{ asset('/assets/sites/images/logo-9.jpg') }}">
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
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
