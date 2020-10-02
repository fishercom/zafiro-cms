<?php

$show_page=get_field($article->metadata, 'show_page');
//$show_menu=get_field($article->metadata, 'show_menu');
?>

	<div class="form-group">
	  {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<label class="col-sm-9 col-lg-11">
		  {!! Form::checkbox('metadata[show_page]', 1, $show_page) !!}
			Ver como página
		</label>
	</div>

