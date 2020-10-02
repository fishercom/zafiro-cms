<?php
$smenu =\App\AdmMenu::FindOrFail($current_module->menu_id);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa {{ $smenu->icon }} ?>"></i> {{ $smenu->name }}
        <small>{{ $current_module->name }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <?php
    if($smenu->parent_id!=null){
      $pmenu=\App\AdmMenu::FindOrFail($smenu->parent_id);
    ?>
        <li class="active">{{ $pmenu->name }}</li>
    <?php
      }
    ?>
    </ol>
</section>