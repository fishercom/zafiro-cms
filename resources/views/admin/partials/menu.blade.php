<?php

use App\Models\User;

$user=Auth::user();
$user_photo = $user->photo;
if(empty( $user_photo )) $user_photo = 'avatar.jpg';

$profile=$user->profile;

$menu_list = \App\Models\AdmMenu::select()
	->where('parent_id', null)
	->where('active', '1')
	->get();

if($profile->id!=1){
	$user_module=\App\Models\AdmModule::select(['id', 'menu_id'])
		->whereIn('id', \App\Models\AdmEvent::select()
			->whereIn('id', \App\Models\AdmPermission::select()
				->where('profile_id', $profile->id)
				->pluck('event_id')
			)
			->pluck('module_id')
		)
		->where('active', true);
}
else{
	$user_module=\App\Models\AdmModule::select()
		->where('active', true);
}

$current_smenu =\App\Models\AdmMenu::FindOrFail($current_module->menu_id);
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="{{ get_userfiles($user_photo) }}" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
			<p>{{ Auth::user()->name }}</p>
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>
	<!-- search form 
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
				</button>
			</span>
		</div>
	</form>
	-->
	<!-- /.search form -->
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
      @foreach ($menu_list as $menu)
		<?php
			$menu_name=strtoupper($menu->name);

			$smenus=\App\Models\AdmMenu::select()
				->whereIn('id', $user_module->pluck('menu_id'))
				->where('parent_id', $menu->id)
				->where('active', true)
				->orderBy('position')
				->get();

			if(count($smenus)==0) continue;
		?>
		<li class="header">{{ $menu_name }}</li>
        @foreach ($smenus as $smenu)
		  <?php
			  $smenu_id=$smenu->id;
			  $smenu_name =$smenu->name;
			  $smenu_icon=$smenu->icon!=''? $smenu->icon: '';
			  $smenu_class=$current_smenu==$smenu? 'active': '';
			  
			  $modules=\App\Models\AdmModule::select()
			  ->whereIn('id', $user_module->pluck('id'))
			  ->where('menu_id', $smenu_id)
			  ->where('active', true)
			  ->orderBy('position')
			  ->get();
			  
			  if(count($modules)==0) continue;
		  ?>
		<li class="treeview {{ $smenu_class }}">
			<a href="#">
				<i class="fa {{ $smenu_icon }}"></i> <span>{{ $smenu_name }}</span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				@foreach ($modules as $module)
				  <?php
					$module_id	  = $module->id;
					$module_name  = $module->name;
					$params 	  = !empty($module->params)? '?'.$module->params: NULL;
					$module_url   = url('/admin/'.$module->controller.$params);
					$module_icon  = $module->icon!=''? $module->icon: 'fa-list';
				    $module_class = $module==$current_module? 'active': '';
				  ?>
				<li class="{{ $module_class }}"><a href="{{ $module_url }}"><i class="fa {{ $module_icon }}"></i> {{ $module_name }}</a></li>
				@endforeach
			</ul>
		</li>
        @endforeach
		
      @endforeach
	</ul>
</section>