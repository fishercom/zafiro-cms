<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSchema extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	use \Rutorika\Sortable\SortableTrait;

	protected $table = 'cms_schemas';
	protected $fillable = ['parent_id', 'group_id', 'name', 'admin_view', 'front_view', 'iterations', 'is_page', 'active'];

	protected static $sortableField = 'position';
	protected static $sortableGroupField = ['parent_id', 'parent_id'];

    public function parent()
    {
        return $this->hasOne('App\CmsSchema', 'id', 'parent_id');
    }

}
