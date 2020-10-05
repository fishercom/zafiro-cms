<?php
use \App\CmsLang;
use \App\Util\SEO;

$login = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'login');
})
->where('site_id', $site->id)
->whereNull('parent_id')
->first();

$registro = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'registro');
})
->where('site_id', $site->id)
->whereNull('parent_id')
->first();

$langs = \App\CmsLang::where('active', true)->get();

?>
<div class="container">
	<div class="caja_logos">
		<div class="logo_1">
			<a href="{{ url('/'.$lang->iso) }}"><img src="{{ asset('/assets/sites/images/logo-expo.png') }}"></a>
		</div>
		<div class="logo_2">
			<a href="#"><img src="{{ asset('/assets/sites/images/logo-adex.png') }}"></a>
		</div>
	</div>

	<div class="btn_menu">
		<div class="o">
			<div class="sanguche">
				<div class="lines"></div>
				<div class="lines"></div>
				<div class="lines"></div>
			</div>
			
		</div>
		<div class="c">
			<div class="exis">
				
			</div>
			
		</div>

	</div>

	<nav>
		<ul class="menu">
			<li class="menu_expo">	
				<a href="#" class="full"></a>			
				¿Qué es Expoalimentaria				
			</li>
			<li class="menu_videos">
				<a href="#" class="full"></a>
				Videos Testimoniales
			</li>
			<li class="menu_eventos">
				<a href="#" class="full"></a>
				Próximos Eventos
			</li>
		@if($login)
			<li class="menu_login">
				<a href="{{ SEO::url_article($login) }}" class="full"></a>
				{{ $login->title }}
			</li>
		@endif
		@if($registro)
			<li class="menu_registro">				
				<a href="{{ SEO::url_article($registro) }}" class="full"></a>
				{{ $registro->title }}
			</li>
		@endif			
		</ul>
		<div class="caja_idiomas">
		@foreach($langs as $item)
			<div class="idioma {{ $item->id==$lang->id? 'activo': ''}}">
				<a href="{{ url('/'.$item->iso) }}" class="full"></a>
				{{ strtoupper($item->iso) }}
			</div>
		@endforeach
		</div>
	</nav>
</div>


<div class="layer_registro">
	<div class="sombra_registro"></div>
	<div class="caja">
		<div class="barra_yellow">
			Registro
			<div class="btn_close"></div>
		</div>

		<div class="box first_box">
			<div class="c">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<article class="usuario_registrado">
								<div class="titulo">
									Usuario Registrado
								</div>
								<div class="formulario">
									<div class="campo">
										<input type="text" placeholder="Usuario">
									</div>
									<div class="campo">
										<input type="text" placeholder="Password">
									</div>
									<div class="campo">
										<input type="checkbox">
										<div class="txt">Mantenerme Logueado</div>
									</div>

									<div class="btn_ingresar">
										Ingresar
									</div>

									<div class="olvidaste">
										¿Olvidaste tu contraseña?
									</div>
								</div>
							</article>
						</div>
						<div class="col-md-6">
							<article class="quiero_registrario">
								<div class="titulo">
									Quiero Registrarme
								</div>
								<div class="formulario">
									<div class="campo">
										<input type="text" placeholder="Nombres">
									</div>
									<div class="campo">
										<input type="text" placeholder="Apellidos">
									</div>
									<div class="campo">
										<input type="text" placeholder="CORREO ELECTRÓNICO">
									</div>
									<div class="campo">
										<input type="text" placeholder="NOMBRE DE LA EMPRESA">
									</div>
									<div class="campo campo_select">
										<select name="" id="">
											<option value="">País</option>
											<option value="">Pais 1</option>
											<option value="">Pais 2</option>
											<option value="">Pais 3</option>
											<option value="">Pais 4</option>
											<option value="">Pais 5</option>
										</select>
									</div>
									<div class="campo">
										<input type="text" placeholder="PASSWORD">
									</div>
									<div class="campo">
										<input type="text" placeholder="CONFIRMAR PASSWORD">
									</div>
									<div class="campo">
										<input type="checkbox">
										<div class="txt">Acepto los terminos y condiciones</div>
									</div>

									<div class="btn_ingresar">
										Registrarse
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
			</div>
				
		</div>

		<div class="box box_olvide">
			<div class="c">
				<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<article>
							<div class="titulo">
								Olvidé Mi contraseña
							</div>
							<div class="texto">
								Ingresa tu email y te enviaremos un correo para restablecer tu contraseña
							</div>
							<div class="formulario">
								<div class="campo">
									<input type="text" placeholder="Correo Electrónico">
								</div>
								<div class="btn_restablecer">
									Restablecer Contraseña
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>
			</div>
			
		</div>
	</div>	
</div>

