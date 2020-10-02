<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $table = 'products';
	protected $fillable = ['category_id', 'subcategory_id', 'brand_id', 'unity_id', 'name', 'resumen', 'description', 'price', 'metadata', 'active'];

    public function category()
    {
        return $this->hasOne('App\CmsParameter', 'id', 'category_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\CmsParameter', 'id', 'subcategory_id');
    }

    public function brand()
    {
        return $this->hasOne('App\CmsParameter', 'id', 'brand_id');
    }

    public function unity()
    {
        return $this->hasOne('App\CmsParameter', 'id', 'unity_id');
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
