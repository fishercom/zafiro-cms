<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmLog extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'adm_logs';
    protected $fillable = ['event_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function event()
    {
        return $this->hasOne('App\AdmEvent', 'id', 'event_id');
    }

}
