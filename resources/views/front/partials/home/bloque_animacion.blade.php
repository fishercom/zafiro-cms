<?php
$items=$bloque_animacion->children;
?>
<div class="banner">
  <ul class="slider">
    @foreach($items as $item)
          <li style="background-image: url({{ userfiles(get_field($item->metadata, 'background')) }});">
            <div class="container">
              {!! $item->resumen !!}
            </div>
          </li>
    @endforeach
  </ul>
</div>
