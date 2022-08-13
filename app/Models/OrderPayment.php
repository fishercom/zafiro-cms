<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
	protected $table = 'order_payments';
	protected $fillable = ['order_id', 'purchaseOperationNumber', 'purchaseAmount', 'descriptionProducts', 'purchaseCurrencyCode', 'authorizationResult', 'authorizationCode', 'errorCode', 'errorMessage', 'metadata'];
    protected $casts = [
        'metadata' => 'array',
    ];

    public function order(){
        return $this->hasOne('App\Models\Order', 'id', 'order_id');
    }

}
