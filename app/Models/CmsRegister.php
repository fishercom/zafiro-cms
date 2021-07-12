<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsRegister extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'cms_registers';
	protected $fillable = ['guid', 'periodo', 'user_id', 'red_salud', 'micro_red', 'establecimiento', 'categoria', 'departamento', 'provincia', 'distrito', 'status'];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
