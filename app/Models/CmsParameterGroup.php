<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsParameterGroup extends Model {

	protected $table = 'cms_parameters_group';
    protected $fillable = ['name', 'alias', 'children', 'active'];

    public function parameters_alias()
    {
        return $this->belongsTo('App\Models\CmsParameterAlias', 'id', 'group_id')
                ->whereIn('id', CmsParameter::where('active', '1')->pluck('alias_id'));
	}

    public function parameters($lang_id=null, $parent_id=null)
    {
        return $this->hasManyThrough('App\Models\CmsParameter', 'App\Models\CmsParameterAlias', 'group_id', 'alias_id', 'id', 'id')
            ->where(function ($query) use($lang_id, $parent_id) {
                if(!empty($lang_id)) $query->where('lang_id', $lang_id);
                if(!empty($parent_id))
                    $query->where('parent_id', $parent_id);
                else
                    $query->whereNull('parent_id');
            })
        	->where('active', '1')
        	->orderBy('position');
    }

}
