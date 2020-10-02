<div class="modal fade" id="mod_schema" tabindex="-1" role="dialog" aria-labelledby="Plantillas" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Seleccionar plantilla:</h4>
      </div>
      <div class="modal-body">
      <ul>
    @foreach ($schemas as $schm)
    <?php
        $params = '?schema_id='.$schm->id.'&parent_id='.$parent->id.'&site_id='.$site->id;
        $cntart = count($articles->where('schema_id', $schm->id));
    ?>
        <li>
        @if ($schm->iterations == null || $cntart < $schm->iterations)
            <a href="{{ route('article.create') }}{{ $params }}">{{ $schm->name }}</a>
        @else
            <del>{{ $schm->name }}</del>
        @endif
        </li>
    @endforeach
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
