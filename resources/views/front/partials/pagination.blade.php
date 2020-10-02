@if ($data->hasPages())
					<div class="paginador">
						<div class="flecha_left"></div>
						<ul>
    @for ($i = 1; $i <= $data->lastPage(); $i++)
        <li class="{{ ($data->currentPage() == $i) ? 'activo' : null }}">
            <a href="{{ $data->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
						</ul>
						<div class="flecha_right"></div>
					</div>
@endif