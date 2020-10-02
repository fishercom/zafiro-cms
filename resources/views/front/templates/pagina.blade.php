
<div class="seccion_sobre_mejorando">
	<div class="container">
		<div class="breadcrumb_caja">
			<div class="row">								
				<div class="col-12">
					@include('front.partials.breadcrumb')
				</div>
			</div>							
		</div>
	</div>
	<div class="topper t_yellow">
		<div class="container">
			
			<div class="return">
				<a href="{{ url('/') }}" class="full"></a>
				
			</div>
			<div class="ico">
				<img src="images/ico-mejorando.svg">
			</div>
			<h1>
				<span>{{ $page->title }}</span>
			</h1>
		</div>
		
	</div>	
	<div class="contenido">
		<div class="container">
			<div class="row">

				{!! $page->description !!}

			</div>
		</div>	
	</div>

</div>
