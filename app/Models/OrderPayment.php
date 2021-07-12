<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
	protected $table = 'order_payments';
	protected $fillable = ['order_id', 'purchaseOperationNumber', 'purchaseAmount', 'descriptionProducts', 'purchaseCurrencyCode', 'authorizationResult', 'authorizationCode', 'errorCode', 'errorMessage', 'metadata'];

    public function order(){
        return $this->hasOne('App\Models\Order', 'id', 'order_id');
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
