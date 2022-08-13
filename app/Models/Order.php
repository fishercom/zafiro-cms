<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	protected $fillable = ['member_id', 'total', 'money', 'token_payment', 'session_id', 'verification', 'metadata', 'comments', 'status'];
    protected $casts = [
        'metadata' => 'array',
    ];

    public function member()
    {
        return $this->hasOne('App\Models\Member', 'id', 'member_id');
    }

    public function quotation(){
        return $this->hasOne('App\Quotation', 'id', 'quotation_id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\OrderPayment', 'order_id', 'id');
    }

}
