<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'name', 'lastname', 'profile_id', 'is_member', 'metadata', 'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function member()
    {
        return $this->hasOne('App\Models\Member', 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'id', 'profile_id');
    }

    public function setPasswordAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['password'] = \Hash::make($value);            
        }

        return $this->attributes['password'];
    }

    public function findForPassport($identifier) {
        //return $this->where('email', $identifier)->where('member', true)->first();
        return $this->where('email', $identifier)->first();
    }

}
