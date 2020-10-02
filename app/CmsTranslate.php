<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsTranslate extends Model {

	protected $table = 'cms_translates';
	protected $fillable = ['alias', 'input_type', 'metadata'];

    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    public function getMetadataAttribute($value)
    {
        return json_decode($value, true);
    }

}
