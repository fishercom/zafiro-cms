<?php
function show_modules($menu, $profile_id){
	$modules=$menu->modules;
	foreach($modules as $module){
		$module_id=$module->id;
		$events=$module->events;

		echo "<li class=\"open\"><span>$module->name</span><ul>";
		foreach ($events as $event) {
			echo "<li><input type=\"checkbox\" class=\"flat-blue\" name=\"events[]\" id=\"ev_".$event->id."\" value=\"".$event->id."\"";
			if(count($event->profile_permissions($profile_id)->get())>0) echo " checked";
			echo "> <label for=\"ev_".$event->id."\">".$event->action->name."</label></li>";
		}
		echo "</ul></li>";
	}
}

$menus=\App\AdmMenu::select()
	->whereNull('parent_id')
	->where('active', '1')
	->orderBy('position')
	->get();
?>
<div class="box-body">

	<div class="form-group">
		{!! Form::label('name', 'Nombre', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
	</div>

@if(!isset($profile) or !$profile->sa)
    <div class="form-group">
      <label class="col-sm-2 control-label ">Permisos</label>
      <div class="col-sm-10">

	 <div id="sidetreecontrol" style="float:right">
	 	<a href="#">Contraer items</a> | <a href="#">Expandir items</a></div> 
		<ul id="tree">
		@foreach($menus as $menu)
		<?php
			$menu_id=$menu->id;
			$smenus=$menu->children;
		?>
			{{ show_modules($menu, $profile->id) }}
			<li class="open"><span>{{ $menu->name }}</span>
				<ul>
				@foreach($smenus as $smenu)
				<?php
					$menu_id=$smenu->menu_id;
				?>
					<li class="open"><span>{{ $smenu->name }}</span>
						<ul>
							{{ show_modules($smenu, $profile->id) }}
						</ul>
					</li>
				@endforeach
				</ul>
			</li>
		@endforeach
		</ul>
      </div>
    </div>
@endif
	<div class="form-group">
    {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<label class="col-sm-9 col-lg-11">
		  {!! Form::checkbox('active', 1) !!}
			Activo
		</label>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('profile.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
<link rel="stylesheet" href="{{ url('/assets/plugins/treeview/jquery.treeview.css') }}" /> 
<script src="{{ url('/assets/plugins/treeview/lib/jquery.cookie.js') }}" type="text/javascript"></script> 
<script src="{{ url('/assets/plugins/treeview/jquery.treeview.js') }}" type="text/javascript"></script> 
<script type="text/javascript"> 
$(function() {
    $("#tree").treeview({
        collapsed: true,
        animated: "medium",
        control:"#sidetreecontrol",
        persist: "location"
    });
})
</script> 