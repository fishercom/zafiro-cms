<?php
use \App\Util\SEO;

$menu = get_article('seccion_content');
$footer = get_article('seccion_footer');

$bloque_redes = null;
if($footer){
	$bloque_redes=$footer->find_template('bloque_redes')->first();
	//$bloque_redes=$footer->find_template('bloque_redes')->first();	
}
?>

@if(!in_array($page->front_view, ['form_login', 'form_registro']) && !Str::startsWith($page->route_view, 'front.account'))
	@include('front.partials.bloque_registro')
@endif

	<div class="superior">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div class="logo_white">
						<a href="#"><img src="{{ asset('/images/logo-negativo.svg') }}"></a>
						<div class="line_vertical"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
					@if($menu)
						<div class="col-12">
							<ul class="menu_footer">
							@foreach($menu->children as $item)
								<li>
									<a href="{{ url_article($item) }}">
										{{ Str::upper($item->title) }}
									</a>
								</li>
							@endforeach
							</ul>
						</div>
					@endif
					</div>
				</div>
				<div class="col-md-4">
					<div class="caja_redes">
						<a href="#" target="_blank"><img src="{{ asset('/images/ico-face.svg') }}"></a>
						<a href="#" target="_blank"><img src="{{ asset('/images/ico-twitter.svg') }}"></a>
						<a href="#" target="_blank"><img src="{{ asset('/images/ico-instagram.svg') }}"></a>
					</div>

					<div class="botonera">
						<div class="boton">
							<a href="#" class="full"></a>
							Preguntas frecuentes
							<div class="ico">
								<img src="{{ asset('/images/ico-interrogacion.svg') }}">
							</div>
						</div>
						<div class="boton">
							<a href="#" class="full"></a>
							Libro de reclamaciones
							<div class="ico">
								<img src="{{ asset('/images/ico-libro.svg') }}">
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
			
	</div>	
	<div class="inferior">
		<div class="container">
			© Todos los derechos reservados Hatun 2020
		</div>
		
	</div>
