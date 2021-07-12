<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = 'inventories';
	protected $fillable = ['local_id', 'product_id', 'price', 'active'];
}
