<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';
	protected $fillable = ['member_id', 'ruc', 'name', 'owner_name', 'owner_document', 'phone_1', 'phone_2', 'website', 'metadata', 'contact', 'billingdata', 'verified', 'status_id'];


    public function member()
    {
        return $this->hasOne('App\Models\Member', 'id', 'member_id');
    }

    public function locals()
    {
        return $this->hasMany('App\Models\Local', 'company_id', 'id');
    }

    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    public function getMetadataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = json_encode($value);
    }

    public function getContactAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setBillingdataAttribute($value)
    {
        $this->attributes['billingdata'] = json_encode($value);
    }

    public function getBillingdataAttribute($value)
    {
        return json_decode($value, true);
    }

}
