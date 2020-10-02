<?php
use \App\CmsLang;
use Illuminate\Support\Facades\Cookie;

$menu = get_article('seccion_content');
$header = get_article('seccion_header');

if(Auth::check()){
	$user = Auth::user();
	$member = $user->member;
	if($member->member_type=='COMPANY'){
		$company = $member->company;
		$photo = get_field($company->metadata, 'logo');
		$url_photo = !empty($photo)? get_userfiles($photo): url('/userfiles/perfil.png');
		$user_name = $company->name;
		$url_account = url('/empresa');
		$notice = App\Quotation::where('company_id', $company->id)->where('status',  '=', 'PENDING')->count();
	}
	else{
		$photo = get_field($member->metadata, 'photo');
		$url_photo = !empty($photo)? get_userfiles($photo): url('/userfiles/perfil.png');
		$user_name = $user->name.' '.$user->lastname;
		$url_account = url('/cliente');
		$notice = App\Quotation::where('member_id', $member->id)->whereIn('status', ['ATTENDED', 'REFUSED'])->count();
	}
}



$district_id = $ubigeo;
$province_id = substr($ubigeo, 0, 4);
$department_id = substr($ubigeo, 0, 2);

$department_list = get_department_pluck();
$province_list = get_province_pluck($department_id);
$district_list = get_district_pluck($department_id, $province_id);

?>
<div class="container">
	
	<div class="logo">
		<a href="{{ url('/') }}"><img src="{{ asset('/images/logo.svg') }}"></a>
	</div>	

	@if(Auth::check())
	<div class="barra_usuario">
		<div class="c">
			<a href="{{ $url_account }}">Bienvenido: {{ $user_name }}</a>
			<form name="frm_user" method="post" action="{{ url('front/logout') }}">
				@csrf
			</form>
			<div class="cerrar">
				<a href="#" onclick="document.forms['frm_user'].submit()" class="full"></a>
				cerrar sesión
			</div>	
		</div>
		<div class="imagen">
			<div class="foto">
				<a href="#" class="full"></a>
				<img src="{{ $url_photo }}">
			</div>
		@if($notice>0)
			<div class="symbol">{{ $notice }}</div>
		@endif
		</div>
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
			<div class="exis">
				
			</div>			
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

	@if($header)
		<ul class="caja_details">
	@foreach($header->children as $item)
	<?php
		if(Auth::check() && $item->schema->front_view=='form_registro') continue;

		$title = $item->title;
		$url = url_redirect($item);
		$estilo = get_field($item->metadata, 'estilo');
	?>
			<li class="{{ $estilo }}">	
				<a href="{{ $url }}" class="full"></a>
				<div class="ico"></div>
				<div class="txt">{{ $title }}</div>
			</li>
	@endforeach
		</ul>
	@endif
		
	</nav>
</div>


<div class="sombra_layer"></div>

<div class="layer_ubicacion">
	<div class="close"></div>
	<div class="cabecera">
		<div class="ico"></div>
		<div class="titulo">
			Productos Cerca de Ti
		</div>
	</div>
	<div class="caja">
		<div class="parrafo">
			Podemos ubicar las ferreterías y sus productos que están más cerca a tu dirección
		</div>

		<div class="formulario">
			<form id="frm_ubigeo" method="post" action="{{ url('/api/ubigeo/save_cookie') }}">
				@csrf
			<div class="col-12">
				{!! Form::select('department_id', $department_list, $department_id, ['placeholder'=>'Departamento', 'class'=>'form-control']) !!}
			</div>
			<div class="col-12">
				{!! Form::select('province_id', $province_list, $province_id, ['placeholder'=>'Provincia', 'class'=>'form-control']) !!}
				</select>
			</div>
			<div class="col-12">
				{!! Form::select('district_id', $district_list, $district_id, ['placeholder'=>'Distrito', 'class'=>'form-control']) !!}
			</div>

			<div class="container">
				<div class="row">
					<div class="col-6">
						<div id="btn_keep_ubigeo" class="boton rojo">
							<a href="#" class="full"></a>
							Mantener
						</div>
					</div>
					<div class="col-6">
						<div id="btn_save_ubigeo" class="boton amarillo">							
							<a href="#" class="full"></a>
							Cambiar
						</div>		
					</div>
									
				</div>
			</div>
			</form>
		</div>			
	</div>

</div>

