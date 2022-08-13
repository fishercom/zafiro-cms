<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $table = 'products';
	protected $fillable = ['category_id', 'subcategory_id', 'brand_id', 'unity_id', 'name', 'resumen', 'description', 'price', 'metadata', 'active'];
    protected $casts = [
        'metadata' => 'array',
    ];

    public function category()
    {
        return $this->hasOne('App\Models\CmsParameter', 'id', 'category_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\Models\CmsParameter', 'id', 'subcategory_id');
    }

    public function brand()
    {
        return $this->hasOne('App\Models\CmsParameter', 'id', 'brand_id');
    }

    public function unity()
    {
        return $this->hasOne('App\Models\CmsParameter', 'id', 'unity_id');
    }

}
