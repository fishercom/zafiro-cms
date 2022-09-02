<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;

use App\Util\SEO;
use App\Util\Transl;

use App\Models\CmsArticle;
use App\Models\CmsSchema;
use App\Models\CmsLang;
use App\Models\CmsSite;

use View;

class FrontController extends Controller {

	protected $member;
    protected $redirectTo = '/';

	public function __construct()
	{
		$this->site = CmsSite::where('default', true)->first();

		View::share('site', $this->site);
	}

	public function index()
	{
		return $this->home('es');
	}

	public function home($iso)
	{
		$lang = CmsLang::where('iso', $iso)->first();
		$page = get_article('home_page', $lang->id);

		//Page not found
		if(!$page){
			return view('front.welcome');
		}

		$page->front_view = $page->schema->front_view;
		$page->route_view = 'front.templates.'.$page->front_view;

		//setlocale(LC_ALL, $lang->iso);
		return view('front.home', compact('page', 'lang'));
	}

	public function page($slug, Request $request)
	{
		$page = get_article_slug($slug, $this->site->id);

		//Page not found
		if(!$page){
			$url=SEO::url_notfound();
			return redirect($url);
		}

		$schema=$page->schema;

		//Redirect to parent
		if(!$schema->is_page){
			$url=SEO::url_redirect_id($page->parent_id);
			return redirect($url);
		}

		//Redirect to first children
		if($schema->front_view=='contenedor' && count($page->children)>0){
			$url=SEO::url_article($page->children->first());
			return redirect($url);
		}

		//Put content to iframe template
		if($request->has('iframe')){
			return view('front.iframe', array('page'=>$page));
		}

		$page->front_view = $page->schema->front_view;
		$page->route_view = 'front.templates.'.$page->front_view;
		$lang = CmsLang::find($page->lang_id);

		//setlocale(LC_ALL, $lang->iso);
		return view('front.page', compact('page', 'lang'));
	}

	public function popup()
	{

		return view('front.layers.popup');
	}

}
