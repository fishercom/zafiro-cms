<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
	protected $table = 'locals';
	protected $fillable = ['company_id', 'name', 'phone_office', 'phone_mobile', 'website', 'department_id', 'province_id', 'district_id', 'zip_code', 'address', 'latitude', 'longitude', 'metadata', 'active'];


    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }

    public function inventories()
    {
        return $this->hasMany('App\Models\Inventory', 'local_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer', 'local_id', 'id');
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
