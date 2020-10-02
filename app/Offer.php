<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
	protected $table = 'offers';
	protected $fillable = ['local_id', 'product_id', 'discount', 'expire_date', 'active'];

    public function local()
    {
        return $this->hasOne('App\Local', 'id', 'local_id');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

}
