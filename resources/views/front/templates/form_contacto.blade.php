<div class="seccion_formulario">
	<div class="container">
		<div class="breadcrumb_caja">
			<div class="row">								
				<div class="col-12">
					@include('front.partials.breadcrumb')
				</div>
			</div>							
		</div>
	</div>
	<div class="topper t_yellow">
		<div class="container">
			
			<div class="return">
				<a href="index.php" class="full"></a>
				
			</div>
			<div class="ico ico_mail">
				<img src="images/ico-mail-black.svg">
			</div>
			<div class="titulo">
				<span>{{ $page->title }}</span>
			</div>						
		</div>
		
	</div>	

	
	<div class="container">
		

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="bloque_formulario">
					<div class="row padd-10">
						
						<div class="col-12">
							<div class="campo">
								<input type="text" placeholder="Nombre*">
							</div>
						</div>
						<div class="col-12">
							<div class="campo">
								<input type="text" placeholder="Apellidos*">
							</div>
						</div>
						<div class="col-12">
							<div class="campo">
								<input type="text" placeholder="Teléfono*">
							</div>
						</div>
						<div class="col-12">
							<div class="campo">
								<input type="text" placeholder="E-mail*">
							</div>
						</div>
						
						<div class="col-12">
							<div class="subtitulo">
								Mensaje
							</div>
						</div>
						<div class="col-12">
							<div class="campo">
								<textarea name="" placeholder="Estoy Interesado..."></textarea>
							</div>
						</div>

						<div class="col-12">
							<div class="campo_check check_contactenos">
								<input type="checkbox">
								<div class="txt">
									Acepto <a href="terminos.php">términos y condiciones</a>
								</div>
							</div>

							<div class="btn_registrarme amarillo btn_contactenos">								
								Enviar
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
		</div>


	</div>
</div>

