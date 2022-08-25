<?php
use \App\Models\CmsLang;
use Illuminate\Support\Facades\Cookie;

$menu = get_article('menu_principal');

?>
<div class="container">
	
	<div class="btn_menu">
		<div class="o">
			<div class="sanguche">
				<div class="lines"></div>
				<div class="lines"></div>
				<div class="lines"></div>
			</div>			
		</div>
		<div class="c">
			<div class="exis"></div>			
		</div>
	</div>	

	<nav>
	@if($menu)
		<ul class="menu">
		@foreach($menu->children as $item)
		<?php
			$activo = $page->front_view == $item->schema->front_view? 'activo': null;
			$icono_menu = get_field($item->metadata, 'icono_menu');
		?>
			<li class="{{ $activo }}">
				<a href="{{ url_article($item) }}" class="full"></a>
				<div class="ico" style="background-image: url({{ userfiles($icono_menu)  }})"></div>
				{{ $item->title }}
			</li>
		@endforeach
		</ul>
	@endif

	</nav>
</div>
