<?php
use \App\CmsLang;
use Illuminate\Support\Facades\Cookie;

$menu = get_article('seccion_content');

?>
<div class="container">
	
	<div class="logo">
		<a href="{{ url('/') }}"><img src="{{ asset('/images/logo.svg') }}"></a>
	</div>	

	@if(Auth::check())
	<div class="barra_usuario">

	</div>
	@endif

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
				<div class="ico" style="background-image: url({{ get_userfiles($icono_menu)  }})"></div>
				{{ $item->title }}
			</li>
		@endforeach
		</ul>
	@endif

	</nav>
</div>
