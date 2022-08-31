<?php 

if (!function_exists('get_article')) {
    /**
     * Returns an article object
     * */
    function get_article($front_view, $site_id=1, $lang_id=1)
    {
        $page = \App\Models\CmsArticle::whereHas('schemas', function($query) use($front_view){
            $query->where('front_view', $front_view);
        })
        ->where('site_id', $site_id)
        ->where('lang_id', $lang_id)
        ->first();

        return $page;
    }
}
if (!function_exists('get_article_root')) {
    /**
     * Returns an article object
     * */
    function get_article_root($front_view, $site_id=1, $lang_id=1)
    {
        $page = \App\Models\CmsArticle::whereHas('schemas', function($query) use($front_view){
            $query->where('front_view', $front_view);
        })
        ->whereNull('parent_id')
        ->where('site_id', $site_id)
        ->where('lang_id', $lang_id)
        ->first();

        return $page;
    }
}
if (!function_exists('get_article_list')) {
    /**
     * Returns an article list
     * */
    function get_article_list($front_view, $site_id=1, $lang_id=1, $parent_id=null)
    {

        $paginas = \App\Models\CmsArticle::whereHas('schemas', function ($query) use($front_view){
            $query->where('front_view', $front_view);
        })
        ->where(function($query) use($parent_id){
            if(!empty($parent_id)) $query->where('parent_id', $parent_id);
        })
        ->where('site_id', $site_id)
        ->where('lang_id', $lang_id)
        ->get();

        return $paginas;
    }
}

if (!function_exists('get_article_slug')) {
    /**
     * Returns an article object
     * */
    function get_article_slug($slug, $site_id)
    {
        $page = \App\Models\CmsArticle::where('slug', $slug)
                ->where('site_id', $site_id)
                ->first();

        return $page;
    }
}

if (!function_exists('url_article')) {
    /**
     * Returns a url of article
     * */
    function url_article($page)
    {
        return \App\Util\SEO::url_article($page);
    }
}

if (!function_exists('url_redirect')) {
    /**
     * Returns an url of article
     * */
    function url_redirect($article, $params=NULL)
    {

        return \App\Util\SEO::url_redirect($article, $params);
    }
}

if (!function_exists('url_target')) {
    /**
     * Returns an url of article
     * */
    function url_target($article)
    {

        return \App\Util\SEO::url_target($article);
    }
}

if (!function_exists('transl')) {
    /**
     * Returns a translation of current lang
     * */
    function transl($word)
    {

        return App\Util\Transl::get($word);
    }
}

if (!function_exists('get_field')) {
    /**
     * Returns a value from xml content field
     * */
    function get_field($arr, $field)
    {
        if(is_array($arr) && isset($arr[$field]))
            return $arr[$field];
        else
            return null;
    }
}

if (!function_exists('get_directory')) {
    /**
     * Returns userfiles resource url
     * */
    function get_directory($alias)
    {
        $directory=\App\Models\CmsDirectory::select()->where('alias', $alias)->first();
        return $directory? $directory->path: '';
    }
}

if (!function_exists('userfiles')) {
    /**
     * Returns userfiles resource url
     * */
    function userfiles($resource)
    {
        return asset('/userfiles/'.$resource);
    }
}

if (!function_exists('parameter_list')) {
    /**
     * Returns a list of parameters by lang
     * */
    function parameter_list($group_alias, $parent_id=null)
    {
        return App\Models\CmsParameter::whereIn('group_id', App\Models\CmsParameterGroup::where('alias', $group_alias)->pluck('id'))
            ->where('parent_id', $parent_id)
            ->where('active', true)
            ->orderBy('position')
            ->get();
    }
}

if (!function_exists('parameter_pluck')) {
    /**
     * Returns a list of parameters by lang
     * */
    function parameter_pluck($group_alias,  $parent_id=null)
    {
        return App\Models\CmsParameter::select('name', 'id')
            ->whereIn('group_id', App\Models\CmsParameterGroup::where('alias', $group_alias)->pluck('id'))
            ->where('parent_id', $parent_id)
            ->where('active', true)
            ->orderBy('position')
            ->pluck('name', 'id');
    }
}

if (!function_exists('parameter_find')) {
    /**
     * Returns an item of parameters by id and lang
     * */
    function parameter_find($id)
    {

        return App\Models\CmsParameter::find('id', $id);
    }
}

if (!function_exists('parameter_value')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function parameter_value($value)
    {

        return App\Models\CmsParameter::where('value', $value)->first();
    }
}

if (!function_exists('get_country_pluck')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function get_country_pluck()
    {

        return App\Models\Country::where('active', true)->pluck('name', 'id');
    }
}

if (!function_exists('get_department_pluck')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function get_department_pluck()
    {

        return App\Models\UbgDepartment::pluck('name', 'id');
    }
}
if (!function_exists('get_province_pluck')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function get_province_pluck($department_id)
    {

        return App\Models\UbgProvince::where('department_id', $department_id)
        ->pluck('name', 'id');
    }
}
if (!function_exists('get_district_pluck')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function get_district_pluck($department_id, $province_id)
    {

        return App\Models\UbgDistrict::where('department_id', $department_id)
        ->where('province_id', $province_id)
        ->pluck('name', 'id');
    }
}
if (!function_exists('upload_base_path')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function upload_base_path()
    {

        return base_path().'/public/userfiles/';
    }
}
if (!function_exists('youtube_url')) {
    /**
     * Returns an item of parameters by value and lang
     * */
    function youtube_url($url){

        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        if(count($matches)>0) $url='https://www.youtube.com/embed/'.$matches[0];

        return $url;
    }
}
if (!function_exists('exportExcel')){
    /**
     * Generate SpreedSheet document for download.
     */
    function exportExcel($head, $data, $filename)
    {
        return Excel::download(new \App\Util\ExcelExport($head, $data), $filename.'.xlsx');
    }
}
