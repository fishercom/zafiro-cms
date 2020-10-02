<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmModule extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'adm_modules';
	protected $fillable = ['name', 'active'];

    public function events()
    {
        return $this->hasMany('App\AdmEvent', 'module_id', 'id');
    }

}
