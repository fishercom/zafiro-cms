<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	protected $table = 'members';
	protected $fillable = ['user_id', 'document_type', 'document', 'phone', 'department_id', 'province_id', 'district_id', 'postal', 'location', 'address', 'reference', 'metadata', 'member_type', 'acceptance', 'status'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company', 'member_id', 'id');
    }

    public function department()
    {
        return $this->hasOne('App\Models\UbgDepartment', 'id', 'department_id');
    }

    public function province()
    {
        return $this->hasOne('App\Models\UbgProvince', 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne('App\Models\UbgDistrict', 'id', 'district_id');
    }

    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    public function getMetadataAttribute($value)
    {
        return json_decode($value, true);
    }

}
