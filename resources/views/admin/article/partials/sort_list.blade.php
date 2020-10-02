<?php
//var_dump($articles->get());
?>
<script src="{{ asset('/assets/admin/js/custom-sortable.js') }}"></script>
<style type="text/css">
@import url("{{ asset('/assets/admin/css/sortable.css') }}");
</style>
  <div class="modal fade" id="sort_modal" tabindex="-1" role="dialog" aria-labelledby="sortLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="sortLabel">Ordena los elementos</h4>
        </div>
        {!! Form::open(['url' => 'admin/article/sort', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
          {!! Form::hidden('schema_id', $schema->id) !!}
          {!! Form::hidden('parent_id', $parent->id) !!}
          <div class="modal-body">
            <p>Para ordenar la lista, presione sobre un art&iacute;culo y arrastrelo para subir o bajar de posici&oacute;n.<br />
                Finalmente guarde sus preferencias para refrescar la pantalla anterior.</p>
            <div class="container">
              <ol class='vertical simple_with_animation'>
              @foreach ($articles as $article)
                <li rel="{{ $article->id }}">&Colon; {{ $article->title }}<input type="hidden" name="sortlist[]" value="{{ $article->id }}"></li>
              @endforeach
              </ol>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-success">
              <i class="fa fa-check"></i> guardar
            </button>
            <button type="button" id="btnClose" name="btnClose" class="btn btn-danger" data-dismiss="modal">
              <i class="fa fa-arrow-left"></i> cancelar
            </button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
