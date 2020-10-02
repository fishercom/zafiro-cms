<?php

$registro = url_article(get_article('form_registro'));

?>
<div class="seccion_formulario seccion_tipo_de_registro" id="div_login">
	<div class="container">
		<div class="breadcrumb_caja">
			<div class="row">	
				<div class="col-12">
					@include('front.partials.breadcrumb')
				</div>
			</div>							
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>
					Registro
				</h1>
			</div>
			<div class="col-3"></div>
			<div class="col-md-6">
				<div class="bloque_formulario">
					<div class="row">
						<div class="col-12">
							<div class="titulo">
								¿Es la primera vez que haces un pedido con nosotros ?
							</div>
						</div>
						<div class="col-12">
							<div class="btn_registrarme amarillo">
								<a href="#" id="lnk_register" class="full"></a>
								Regístrate
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-3"></div>
			<div class="col-md-6">
				<form id="frm_login" method="post" action="{{ url('/front/login') }}">
				<div class="bloque_formulario bloque_right">
					<div class="row">
						<input type="hidden" name="redir" value="{{ Request::get('redir') }}">
						@csrf
						<div class="col-12">
							<div class="titulo">
								¿Ya estas registrado en nuestra tienda?
							</div>
						</div>
						
						<div class="col-12">
							<div class="campo">
								<input type="email" name="email" required="true" placeholder="Correo">
							</div>
						</div>
						<div class="col-12">
							<div class="campo">
								<input type="password" name="password" required="true" placeholder="Contraseña">
							</div>
						</div>

						<div class="col-6">
							<a href="#">Olvidé Clave</a>
						</div>
						<div class="col-6">
							<input type="submit" style="display: none">
							<div id="btn_login" class="btn_registrarme amarillo">
							Ingresar
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<br>
						@include('front.partials.error_handler')
				</div>
				</form>
			</div>
		</div>
	</div>
		
</div>


<div class="seccion_registrate" id="div_register" style="display: none">
	<div class="container">
		<div class="breadcrumb_caja">
			<div class="row">
				<div class="col-12">
					@include('front.partials.breadcrumb')
				</div>
			</div>							
		</div>
		<div class="contenido">
			<div class="row padd-10">
				<div class="col-12">
					<div class="titulo">
						Regístrate y forma parte del mundo ferretero
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<article>
						<div class="ico">
							<img src="images/ico-carrito.svg">
						</div>
						<div class="txt">Quiero comprar materiales y construir mi obra</div>

						<div class="btn_registrarme amarillo">
							<a href="{{ $registro }}?type=member" class="full"></a>
							Registrarme
						</div>
					</article>
				</div>
				<div class="col-md-4">
					<article>
						<div class="ico">
							<img src="images/ico-ferreteria.svg">
						</div>
						<div class="txt">Soy una ferretería y quiero ofrecer mis materiales</div>

						<div class="btn_registrarme rojo">
							<a href="{{ $registro }}?type=company" class="full"></a>
							Registrarme
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#btn_login').click(function(){
		$('#frm_login').submit();
	});
	$('#lnk_register').click(function(){
		$('#div_login').hide();
		$('#div_register').fadeIn();
	});
});
</script>
