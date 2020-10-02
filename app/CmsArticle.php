<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CmsArticle extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    use Sluggable;
    use \Rutorika\Sortable\SortableTrait;

	protected $table = 'cms_articles';
    protected $fillable = ['schema_id', 'parent_id', 'lang_id', 'site_id', 'title', 'subtitle', 'subtitle2', 'resumen', 'description', 'description2', 'description3', 'date', 'ref_type', 'ref_id', 'ref_url', 'ref_target', 'metadata', 'in_home', 'slug', 'active'];
    protected static $sortableField = 'position';
    protected static $sortableGroupField = 'parent_id';

    public $front_view = null;
    public $route_view = null;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'ParentSlug'
            ]
        ];
    }

    public function getParentSlugAttribute() {
        $pslug=$this->parent!=NULL? $this->parent->slug.'_': '';
        return $pslug . $this->title;
    }

    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    public function getMetadataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function parent()
    {
        return $this->belongsTo('App\CmsArticle', 'parent_id');
    }

    public function lang()
    {
        return $this->belongsTo('App\CmsLang', 'lang_id');
    }

    public function schema()
    {
        return $this->belongsTo('App\CmsSchema', 'schema_id');
    }

    public function schemas()
    {
        return $this->hasMany('App\CmsSchema', 'id', 'schema_id');
    }

    public function page_schemas()
    {
        return $this->hasMany('App\CmsSchema', 'id', 'schema_id')
            ->where('is_page', '1')
            ->where('active', '1')
            ->orderBy('position');
    }

    public function children()
    {
        return $this->hasMany('App\CmsArticle', 'parent_id', 'id')
        	->where('active', '1')
        	->orderBy('position');
    }

    public function submenu()
    {
        return $this->hasMany('App\CmsArticle', 'parent_id', 'id')
			->whereIn('schema_id', \App\CmsSchema::select('id')
				->where('is_page', '1')->get()->toArray()
				)
            ->where('active', '1')
        	->orderBy('position');
    }

    public function find_template($front_view)
    {
        return $this->hasOne('App\CmsArticle', 'parent_id', 'id')
            ->whereHas('schemas', function ($query) use($front_view) {
                $query->where('front_view', $front_view);
            });
    }

    public function child_template($front_view)
    {
        return $this->hasMany('App\CmsArticle', 'parent_id', 'id')
            ->whereHas('schemas', function ($query) use($front_view) {
                $query->where('front_view', $front_view);
            })
            ->where('active', '1')
            ->orderBy('position');
    }

}
