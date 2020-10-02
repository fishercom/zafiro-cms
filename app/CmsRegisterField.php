<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CmsParameter;


class CmsRegisterField extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'cms_register_fields';
    protected $fillable = ['register_id', 'field_id', 'value'];
    public $timestamps = false;

    public function field()
    {
        return $this->belongsTo('App\CmsFormField', 'field_id');
    }

    public function register()
    {
        return $this->belongsTo('App\CmsRegister', 'register_id');
    }

}
