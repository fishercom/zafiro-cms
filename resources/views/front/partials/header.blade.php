<?php
use \App\Models\CmsLang;
//use Illuminate\Support\Facades\Cookie;

$langs = \App\Models\CmsLang::where('iso', '!=', $lang->iso)->where('active', true)->get();

$menu_principal = get_article('menu_principal', $lang->id);
$menu_header = get_article('menu_header', $lang->id);

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
	@if($menu_principal)
		<ul class="menu">
		@foreach($menu_principal->children as $item)
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
