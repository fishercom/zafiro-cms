@extends('layouts.admin')

@section('content')

<div class="row visible-md visible-lg">
	<div class="col-xs-12">
        <div class="callout callout-info">
            <h4>Info</h4>
            <p>
                En la siguiente lista se muestran todos los m&oacute;dulos del sistema. Estas opciones tambi&eacute;n estar&aacute;n disponibles en el men&uacute; superior.
                Recuerde que en las p&aacute;ginas interiores s&oacute;lo se podr&aacute; acceder usando el menu superior.
            </p>
        </div>
    </div>
</div>

<div class="row">
@foreach ($menu_list as $menu)
<?php
	$menu_id=$menu->id;
	$menu_name=$menu->name;
	$menu_icon=$menu->icon!=''? $menu->icon: 'fa-circle-o';

    $smenus=\App\AdmMenu::select()
        ->whereIn('id', $user_module->pluck('menu_id'))
        ->where('parent_id', $menu_id)
        ->where('active', true)
        ->orderBy('position')
        ->get();

    if(count($smenus)==0) continue;
?>
<div class="col-xs-12 col-sm-6 col-md-4">
    <div class="box">
        <div class="box-header bg-primary"><h3 class="bg-primary"><i class="fa {{ $menu_icon }}"></i> {{ $menu_name }}</h3></div>
        @foreach ($smenus as $smenu)
		  <?php
			  $smenu_id=$smenu->id;
			  $smenu_name =$smenu->name;
			  $smenu_icon=$smenu->icon!=''? $smenu->icon: '';

              $modules=\App\AdmModule::select()
                ->whereIn('id', $user_module->pluck('id'))
                ->where('menu_id', $smenu_id)
                ->where('active', true)
                ->orderBy('position')
                ->get();

              if(count($modules)==0) continue;
		  ?>
        <div class="box-body">
           <h4><i class="fa {{ $smenu_icon }}"></i> {{ $smenu_name }}</h4>
            <table class="table">
                <tr>
                    <td>
				@foreach ($modules as $module)
				  <?php
					$module_id=$module->id;
					$module_name=$module->name;
					$controller=$module->controller;
                    $params =!empty($module->params)? '?'.$module->params: NULL;

                    $module_url =url('/admin/'.$module->controller.$params);
					$module_icon=$module->icon!=''? $module->icon: 'fa-list';
				  ?>
                        <div>
                            <a href="{{ $module_url }}"><i class="fa {{ $module_icon }}"></i> {{ $module_name }}</a>
                        </div>
                @endforeach
                    </td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
</div>
@endforeach

</div>

@endsection
