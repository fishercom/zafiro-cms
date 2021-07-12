<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;

use App\Models\User;
use App\Models\Member;
use App\Models\Company;
use App\Models\Product;
use App\Models\Local;

use Config;
use Auth;
use DB;
use View;

class CartController extends Controller {

    protected $redirectTo = '/';

	public function __construct()
	{
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, "es_PE");
	}

	public function store($product_id, Request $request)
	{
		$page = get_article('pagina_carrito');

		if(!$page){
			$url=SEO::url_notfound(); //Page not found
			return redirect($url);
		}

		$quantity = $request->quantity;
		$cart = session()->get('cart');

		$product = Product::find($product_id);
		if($product && is_numeric($quantity)){
			$cart[$product_id]=isset($cart[$product_id])? $cart[$product_id]+$quantity: $quantity;
			if($cart[$product_id]<=0) unset($cart[$product_id]);
		}
		session(['cart' => $cart]);
		session()->save();

		return redirect(url_article($page));
	}

	public function update(Request $request)
	{
		$cart = $request->cart;
		if(empty($cart)){
			session()->forget('cart');
			return true;
		}

		session(['cart' => $cart]);
		session()->save();

		return true;
	}

}
