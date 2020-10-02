<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('adm_events')->delete();
		DB::table('adm_actions')->delete();
		DB::table('adm_modules')->delete();
		DB::table('adm_menus')->delete();
		DB::table('users')->delete();
		DB::table('profiles')->delete();

		DB::table('cms_register_fields')->delete();
		DB::table('cms_registers')->delete();
		DB::table('cms_form_fields')->delete();
		DB::table('cms_notifies')->delete();
		DB::table('cms_forms')->delete();

		DB::table('cms_articles')->delete();
		DB::table('cms_schemas')->delete();
		DB::table('cms_langs')->delete();

		DB::table('cms_directories')->delete();
		DB::table('cms_filetypes')->delete();

		DB::table('cms_parameters')->delete();
		DB::table('cms_parameters_group')->delete();

		DB::table('cms_translates')->delete();
		
		// Seeding cms_configs
		\App\CmsConfig::create(['type' => 'string', 'name' => 'Site Predeterminado', 'alias' => 'site_name', 'value' => 'CMS']);
		\App\CmsConfig::create(['type' => 'string', 'name' => 'Correo Postmaster', 'alias' => 'postmaster', 'value' => 'no-reply@gmail.com']);
		\App\CmsConfig::create(['type' => 'text', 'name' => 'Google Analytics', 'alias' => 'analytics']);

		// Seeding cms_langs
		$lang_default = \App\CmsLang::create(['name' => 'Español', 'iso' => 'es', 'active'=>'1']);
		$lang_english = \App\CmsLang::create(['name' => 'English', 'iso' => 'en', 'active'=>'1']);

		// Seeding cms_schema_groups
		$schg_default= \App\CmsSchemaGroup::create(['name' => 'Site Principal', 'layout'=>'front', 'default'=>'1', 'active'=>'1']);
		
		// Seeding cms_sites
		$site_root= \App\CmsSite::create(['name' => 'Site Principal', 'segment' => 'hatunsol', 'site_url'=>'http://hatunsol.localhost/', 'schema_group_id'=>$schg_default->id, 'default'=>'1', 'active'=>'1']);

		// Seeding cms_translates_alias

		// Seeding cms_parameters_group
		$pgroup_asunto= \App\CmsParameterGroup::create(['name' => 'Asunto de Contacto', 'alias'=>'asunto', 'active'=>'1']);
		$pgroup_category= \App\CmsParameterGroup::create(['name' => 'Categorías', 'alias'=>'category', 'children'=>true, 'active'=>'1']);
		$pgroup_dashboard= \App\CmsParameterGroup::create(['name' => 'Dashboard', 'alias'=>'dashboard', 'active'=>'1']);
		$pgroup_dashboard= \App\CmsParameterGroup::create(['name' => 'Marcas', 'alias'=>'brand', 'active'=>'1']);

		// Seeding cms_filetypes
		$ftype_image = \App\CmsFileType::create(['name' => 'Imagen', 'extensions' => 'jpg,jpeg,gif,png', 'active'=>'1']);
		$ftype_doc   = \App\CmsFileType::create(['name' => 'Documento', 'extensions' => 'pdf,doc,docx,xls,xlsx,ppt,pptx', 'active'=>'1']);
		$ftype_audio = \App\CmsFileType::create(['name' => 'Audio', 'extensions' => 'mp3,aif,wav', 'active'=>'1']);
		$ftype_video = \App\CmsFileType::create(['name' => 'Video', 'extensions' => 'mov,avi,mpg,mpeg,mp4,wmv', 'active'=>'1']);


		// Seeding cms_directories
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Meta-tag: imagen', 'alias' => 'metatag_imagen', 'path' => 'cms/metatag/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Página: imagen', 'alias' => 'pagina_imagen', 'path' => 'cms/pagina/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Página: icono', 'alias' => 'pagina_icono', 'path' => 'cms/pagina/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_doc->id, 'name' => 'Página: documento', 'alias' => 'pagina_documento', 'path' => 'cms/pagina/documento/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Seccion: imagen', 'alias' => 'seccion_imagen', 'path' => 'cms/seccion/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Animación: foto', 'alias' => 'animacion_home', 'path' => 'cms/home/foto/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Término: Imagenes de Texto', 'alias' => 'termino_imagen', 'path' => 'cms/termino/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Usuario: foto', 'alias' => 'user_photo', 'path' => 'user/photo/', 'active'=>'1']);


		//=============================================================================================================================

		// Seeding cms_forms
		$form_contact = \App\CmsForm::create(['name' => 'Formulario de Contacto', 'alias'=>'contacto', 'active'=>'1']);


		// Seeding profiles
		$perfil_sa = \App\Profile::create(['name' => 'Super', 'active'=>'1', 'sa'=>'1']);
		$perfil_admin = \App\Profile::create(['name' => 'Admin', 'active'=>'1']);
		$perfil_webmaster = \App\Profile::create(['name' => 'Webmaster', 'active'=>'1']);


		// Seeding users
		$user_admin = \App\User::create(['username'=>'fischer', 'email' => 'fishdev@gmail.com', 'password' => 'admin', 'name' => 'Administrador', 'profile_id' => $perfil_sa->id, 'active' => '1', 'default' => '1']);


		// Seeding menus
		$menu_home = \App\AdmMenu::create(['name' => 'Inicio', 'position'=>'0', 'active'=>'0']);
		$menu_conf = \App\AdmMenu::create(['name' => 'Configuración', 'icon' => 'fa-gear', 'position'=>'1', 'active'=>'1']);
		$menu_info = \App\AdmMenu::create(['name' => 'Información general', 'icon' => 'fa-info-circle', 'position'=>'2', 'active'=>'1']);
		$menu_webs = \App\AdmMenu::create(['name' => 'Website Principal', 'icon' => 'fa-sitemap', 'position'=>'3', 'active'=>'1']);

		$menu_back = \App\AdmMenu::create(['parent_id'=>$menu_conf->id, 'name' => 'Administrador', 'icon' => 'fa-dashboard', 'position'=>'1', 'active'=>'1']);
		$menu_web = \App\AdmMenu::create(['parent_id'=>$menu_conf->id, 'name' => 'Website', 'icon' => 'fa-sitemap', 'position'=>'2', 'active'=>'1']);
		$menu_cms = \App\AdmMenu::create(['parent_id'=>$menu_conf->id, 'name' => 'CMS', 'icon' => 'fa-edit', 'position'=>'3', 'active'=>'1']);
		$menu_forms = \App\AdmMenu::create(['parent_id'=>$menu_info->id, 'name' => 'Formularios', 'icon' => 'fa-list-alt', 'position'=>'2', 'active'=>'1']);
		$menu_modules = \App\AdmMenu::create(['parent_id'=>$menu_info->id, 'name' => 'Módulos del Sistema', 'icon' => 'fa-cogs', 'position'=>'1', 'active'=>'1']);
		$module_contenido = \App\AdmMenu::create(['parent_id'=>$menu_webs->id, 'name' => 'Contenido Web', 'icon' => 'fa-globe', 'position'=>'1', 'active'=>'1']);


		// Seeding adm_modules
		$module_inicio = \App\AdmModule::create(['menu_id' => $menu_home->id, 'name' => 'Dashboard', 'controller' => 'home', 'position'=>'0', 'active'=>'1']);
		$module_acceso = \App\AdmModule::create(['menu_id' => $menu_home->id, 'name' => 'Acceso al Sistema', 'controller' => 'login', 'position'=>'0', 'active'=>'1']);
		$module_usradm = \App\AdmModule::create(['menu_id' => $menu_back->id, 'name' => 'Usuarios del Sistema', 'title' => 'usuario', 'controller' => 'user', 'icon'=>'fa-user', 'position'=>'1', 'active'=>'1']);
		$module_perfil = \App\AdmModule::create(['menu_id' => $menu_back->id, 'name' => 'Perfiles', 'title' => 'perfil', 'controller' => 'profile', 'icon'=>'fa-male', 'position'=>'2', 'active'=>'1']);
		$module_reglog = \App\AdmModule::create(['menu_id' => $menu_back->id, 'name' => 'Registro de Logs', 'title' => 'log', 'controller' => 'log', 'icon'=>'fa-book', 'position'=>'3', 'active'=>'1']);
		$module_idioma = \App\AdmModule::create(['menu_id' => $menu_web->id, 'name' => 'Idiomas', 'title' => 'idioma', 'controller' => 'lang', 'icon'=>'fa-flag', 'position'=>'2', 'active'=>'1']);
		$module_transl= \App\AdmModule::create(['menu_id' => $menu_web->id, 'name' => 'Traducciones', 'title' => 'traducción', 'controller' => 'translate', 'icon'=>'fa-list', 'position'=>'4', 'active'=>'1']);
		$module_mensaje= \App\AdmModule::create(['menu_id' => $menu_forms->id, 'name' => 'Mensajes recibidos', 'title' => 'mensaje', 'controller' => 'register', 'icon'=>'fa-inbox', 'position'=>'1', 'active'=>'1']);
		$module_cuenta = \App\AdmModule::create(['menu_id' => $menu_forms->id, 'name' => 'Cuentas de correo', 'title' => 'cuenta', 'controller' => 'notify', 'icon'=>'fa-at', 'position'=>'2', 'active'=>'1']);

		$module_config = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Configuración', 'title' => 'configuración', 'controller' => 'config', 'icon'=>'fa-cog', 'position'=>'1', 'active'=>'1']);
		$module_site = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Sites', 'title' => 'site', 'controller' => 'site', 'icon'=>'fa-globe', 'position'=>'2', 'active'=>'1']);
		$module_schema = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Esquemas', 'title' => 'esquema', 'controller' => 'schema', 'icon'=>'fa-random', 'position'=>'3', 'active'=>'1']);
		$module_directory = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Directorio de Archivos', 'title' => 'directorio', 'controller' => 'directory', 'icon'=>'fa-folder-open', 'position'=>'4', 'active'=>'1']);

		$module_parameter = \App\AdmModule::create(['menu_id' => $menu_modules->id, 'name' => 'Parámetros', 'title' => 'parámetro', 'controller' => 'parameter', 'icon'=>'fa-bell', 'position'=>'1', 'active'=>'1']);
		$module_members = \App\AdmModule::create(['menu_id' => $menu_modules->id, 'name' => 'Miembros', 'title' => 'miembro', 'controller' => 'member', 'icon'=>'fa-users', 'position'=>'3', 'active'=>'1']);
		$module_companies = \App\AdmModule::create(['menu_id' => $menu_modules->id, 'name' => 'Empresas', 'title' => 'empresa', 'controller' => 'company', 'icon'=>'fa-industry', 'position'=>'3', 'active'=>'1']);
		$module_products = \App\AdmModule::create(['menu_id' => $menu_modules->id, 'name' => 'Productos', 'title' => 'producto', 'controller' => 'product', 'icon'=>'fa-cubes', 'position'=>'5', 'active'=>'1']);
		$module_orders = \App\AdmModule::create(['menu_id' => $menu_modules->id, 'name' => 'Órdenes', 'title' => 'orden', 'controller' => 'order', 'icon'=>'fa-shopping-cart', 'position'=>'7', 'active'=>'1']);
		$module_reports = \App\AdmModule::create(['menu_id' => $menu_modules->id, 'name' => 'Reportes', 'title' => 'reporte', 'controller' => 'report', 'icon'=>'fa-line-chart', 'position'=>'9', 'active'=>'1']);

		$module_article = \App\AdmModule::create(['menu_id' => $module_contenido->id, 'name' => 'Páginas', 'title' => 'contenido', 'controller' => 'article', 'icon'=>'fa-file', 'position'=>'1', 'active'=>'1']);


		// Seeding adm_actions
		$action_lista = \App\AdmAction::create(['name' => 'Listar (solo lectura)', 'alias'=>'listar', 'write_log'=>'0']);
		$action_admin = \App\AdmAction::create(['name' => 'Administrar (agregar/modificar/eliminar)', 'alias'=>'administrar', 'write_log'=>'1']);
		$action_login = \App\AdmAction::create(['name' => 'Login (ingresar al sistema)', 'alias'=>'login', 'write_log'=>'1']);
		$action_logout = \App\AdmAction::create(['name' => 'Logout (salir del sistema)', 'alias'=>'logout', 'write_log'=>'1']);

		
		// Seeding adm_events
		\App\AdmEvent::create(['module_id' => $module_acceso->id, 'action_id' => $action_login->id]);
		\App\AdmEvent::create(['module_id' => $module_acceso->id, 'action_id' => $action_logout->id]);
		\App\AdmEvent::create(['module_id' => $module_usradm->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_usradm->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_perfil->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_perfil->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_reglog->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_reglog->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_idioma->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_idioma->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_transl->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_transl->id, 'action_id' => $action_admin->id]);

		\App\AdmEvent::create(['module_id' => $module_config->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_config->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_site->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_site->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_schema->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_schema->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_directory->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_directory->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_mensaje->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_mensaje->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_cuenta->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_cuenta->id, 'action_id' => $action_admin->id]);

		\App\AdmEvent::create(['module_id' => $module_parameter->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_parameter->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_members->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_members->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_companies->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_companies->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_products->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_products->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_orders->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_orders->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_reports->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_reports->id, 'action_id' => $action_admin->id]);

		\App\AdmEvent::create(['module_id' => $module_article->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_article->id, 'action_id' => $action_admin->id]);

	}

}
