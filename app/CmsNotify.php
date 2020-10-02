<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsNotify extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'cms_notifies';
	protected $fillable = ['form_id', 'user_id', 'recipients', 'active'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
