<?php


$form_view = Request::get('type')=='company'? 'register_company': 'register_member';

?>

@include('front.partials.'.$form_view)

<div class="modal fade" id="mapu_layer" role="dialog">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h2 class="modal-title">Ubica tu dirección</h2>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 modal_body_map">
          <div class="location-map">
            <div style="width: 600px; height: 400px;" id="mapu_canvas"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <div class="row">
      	<div class="col-md-12">
      		<a href="#" id="btn_confirm_pos" class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Confirmar</a>
      	</div>
      </div>
    </div>
  </div>
</div>
</div>
