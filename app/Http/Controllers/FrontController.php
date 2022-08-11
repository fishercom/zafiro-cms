<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Front\LoginRequest;
use App\Http\Requests\Front\MemberRequest;
use App\Http\Requests\Front\CompanyRequest;
use Illuminate\Support\Facades\Lang;


use App\Util\SEO;
use App\Util\Transl;

use App\Models\CmsArticle;
use App\Models\CmsSchema;
use App\Models\CmsLang;
use App\Models\User;
use App\Models\Member;
use App\Models\Company;
use App\Models\Product;
use App\Models\Local;
use App\Models\CmsSite;

use Config;
use Auth;
use DB;
use View;

class FrontController extends Controller {

	protected $member;
    protected $redirectTo = '/';

	public function __construct()
	{
		$this->site = CmsSite::where('default', true)->first();

		View::share('site', $this->site);
	}

    public function username()
    {
        return 'email'; //username
    }

	public function index(Request $request)
	{
		$page = get_article('seccion_home', $this->site->id);

		//Page not found
		if(!$page){
			return view('front.welcome');
		}

		$page->front_view = $page->schema->front_view;
		$page->route_view = 'front.templates.'.$page->front_view;

		return view('front.home', compact('page'));
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

		return view('front.page', compact('page'));
	}

	public function member_account($front_view=null, Request $request)
	{
		$user = Auth::user();

		$member = $user->member;
		$pages = [
			'home'=>'Datos de Usuario',
			'favoritas'=>'Ferreterías Favoritas',
			'cotizaciones'=>'Mis Cotizaciones',
			'cotizacion'=>'Detalle de la Cotización',
			'orden_pago'=>'Realizar Pago',
			'resultado_pago'=>'Resultado del Pago',
			'page_expired' => 'Su sesión ha expirado'
		];
		if(!array_key_exists($front_view, $pages)) $front_view='home';

		if($front_view=='orden_pago' && !session('order')) $front_view = 'page_expired';

		$page = new CmsArticle(['title'=>$pages[$front_view], 'description'=>null]);
		$page->front_view = $front_view;
		$page->route_view = 'front.account.member.'.$page->front_view;

		return view('front.page', compact('page', 'member'));
	}

	public function product_search(Request $request)
	{
		$page = get_article('pagina_productos', $this->site->id);

		if(!$page){
			$url=SEO::url_notfound(); //Page not found
			return redirect($url);
		}

		$filter = $request->q;

		$results = Product::where(function($query) use($filter){
				if(!empty($filter)) $query->where('name', 'LIKE', '%'.str_replace(' ', '%', $filter).'%');
			})
			->where('active', true)
			->paginate();

		$page->front_view = $page->schema->front_view;
		$page->route_view = 'front.templates.'.$page->front_view;

		return view('front.page', compact('results', 'filter', 'page'));
	}

	public function product($product_id, $slug, $front_view=null, Request $request)
	{
		$product = \App\Models\Product::find($product_id);
		if(!$product) return redirect('/#404');

		$sections = ['contact_form', 'contact_resp'];
		if(!in_array($front_view, $sections)) $front_view='detail';

		$page = new CmsArticle(['title'=>$product->name, 'description'=>$product->description]);

		$page->front_view = $front_view;
		$page->route_view = 'front.product.'.$page->front_view;

		return view('front.page', compact('page', 'product'));
	}

	public function post_login(LoginRequest $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

			$user = Auth::user();
			$member = $user->member;

			if(!$member){
				Auth::logout();
				return redirect()->back()
					->withInput($request->only($this->username(), 'remember'))
					->withErrors([
						$this->username() => transl('El usuario no es un miembro registrado.'),
					]);
			}

			if(!empty($request->redir))
				return redirect($request->redir);
			else
				return redirect($member->member_type=='COMPANY'? '/empresa': '/cliente');
		}
		else {
			return redirect()->back()
				->withInput($request->only('email', 'remember'))
				->withErrors([
					$this->username() => transl('Los datos ingresados no son correctos.'),
				]);
		}
	}

	public function post_logout()
	{
	    auth()->logout();
	    
		return redirect('/');
	}

	public function register_member(MemberRequest $request)
	{
		$user = User::Create($request->all());

		if ($user) {
			$member = new Member($request->all());
			$member->user_id=$user->id;
			$member->acceptance=$request->acceptance;
			$member->member_type='CLIENT';
			$member->status='ACTIVE'; //Config::get('constants.member_type')
			$member->save();
			//TODO: Verify confirmation by mail

			$user->is_member=true;
			$user->active=true;
			$user->save();

			$gracias = get_article('registro_gracias');

			return redirect(url_article($gracias));
		}
		else {
			return redirect()->back()
				->withInput($request)
				->withErrors([
					$this->username() => transl('Los datos ingresados no son correctos.'),
				]);
		}
	}

	public function popup()
	{

		return view('front.layers.popup');
	}

}
