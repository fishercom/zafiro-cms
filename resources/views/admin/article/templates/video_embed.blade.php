<?php
$video=get_field($article->metadata, 'video');

?>
<div class="form-group">
	{!! Form::label('metadata[embed]', 'Video (embed)', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	<div class="col-sm-9 col-lg-11">
		{!! Form::textarea('metadata[embed]', $video, ['class'=>'form-control']) !!}
	</div>
</div>
