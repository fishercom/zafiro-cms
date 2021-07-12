<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
	protected $table = 'offers';
	protected $fillable = ['local_id', 'product_id', 'discount', 'expire_date', 'active'];

    public function local()
    {
        return $this->hasOne('App\Models\Local', 'id', 'local_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

}
