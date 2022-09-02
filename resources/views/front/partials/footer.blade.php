<?php

$footer = get_article('menu_footer', $lang->id);
$bloque_redes = $footer? $footer->find_template('bloque_redes')->first(): null;
$bloque_terminos = $footer? $footer->find_template('bloque_terminos')->first(): null;
?>
	<div class="inferior">
		<div class="container">
			© Todos los derechos reservados
		</div>
		
	</div>