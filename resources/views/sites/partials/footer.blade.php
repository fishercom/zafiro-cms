<?php
use \App\Util\SEO;

$footer = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'seccion_footer');
})
->whereNull('parent_id')
->first();

$bloque_apps = null;
if($footer){
	$bloque_apps=$footer->find_template('bloque_apps')->first();
	//$bloque_redes=$footer->find_template('bloque_redes')->first();	
}
?>
	<div class="superior">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div class="logo_white">
						<a href="#"><img src="{{ asset('/assets/sites/images/logo-white.svg') }}"></a>
						<div class="line_vertical"></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-sm-5">
							<ul class="menu_footer">
								<li>
									<a href="#">
										¿Qué es Expoalimentaria?
									</a>
								</li>
								<li>
									<a href="#">
										Términos y condiciones
									</a>
								</li>
								<li>
									<a href="#">
										Planes y precios
									</a>
								</li>
							</ul>
						</div>
						<div class="col-sm-4">
							<ul class="menu_footer">								
								<li>
									<a href="#">
										Login
									</a>
								</li>
								<li>
									<a href="#">
										Registro
									</a>
								</li>
								<li>
									<a href="#">
										Contacto
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="caja_redes">
						<a href="#" target="_blank"><img src="{{ asset('/assets/sites/images/ico-face.svg') }}"></a>
						<a href="#" target="_blank"><img src="{{ asset('/assets/sites/images/ico-twitter.svg') }}"></a>
						<a href="#" target="_blank"><img src="{{ asset('/assets/sites/images/ico-instagram.svg') }}"></a>
					</div>

					<div class="botonera">
						<div class="boton">
							<a href="#" class="full"></a>
							Preguntas frecuentes
							<div class="ico">
								<img src="{{ asset('/assets/sites/images/ico-interrogacion.svg') }}">
							</div>
						</div>
						<div class="boton">
							<a href="#" class="full"></a>
							Libro de reclamaciones
							<div class="ico">
								<img src="{{ asset('/assets/sites/images/ico-libro.svg') }}">
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
			© Todos los derechos reservados Expoalimentaria 2020
		</div>		
	</div>
