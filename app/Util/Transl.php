<?php
namespace App\Util;

use App\Models\CmsTranslate;
use App\Models\CmsTranslateLang;

class Transl {
	public static $trans = array();

	public static function prepare($lang='es'){

		$list = CmsTranslate::all();

		foreach ($list as $item) {
			$value = get_field($item->metadata, $lang);
			$key = strtolower($item->alias);
			self::$trans[$key] = empty($value)? $item->alias: $value;
		}
	}

	public static function get($alias)
    {
    	if(count(self::$trans)==0) self::prepare();
    	$key= strtolower($alias);
    	if(!isset(self::$trans[$key])){
    		if(!CmsTranslate::where('alias', $alias)->first()){
	    		CmsTranslate::create(['alias'=>$alias, 'metadata'=>['es'=>$alias], 'input_type'=>1]);
    		}
    		self::$trans[$key] = $alias;
    	}

        return self::$trans[$key];
    }

}
?>