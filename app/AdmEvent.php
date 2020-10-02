<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmEvent extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'adm_events';
    protected $fillable = ['event_id', 'profile_id'];

    public function action()
    {
        return $this->belongsTo('App\AdmAction', 'action_id');
    }

    public function module()
    {
        return $this->belongsTo('App\AdmModule', 'module_id');
    }

    public function permissions()
    {
        return $this->belongsTo('App\AdmPermission', 'event_id', 'id');
    }

    public function profile_permissions($profile_id)
    {
        return $this->hasMany('App\AdmPermission', 'event_id', 'id')
        	->where('profile_id', $profile_id);
    }

}
