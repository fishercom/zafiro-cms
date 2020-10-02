<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSite extends Model
{
	protected $table = 'cms_sites';
	protected $fillable = ['name', 'segment', 'site_url', 'schema_group_id', 'metadata', 'default', 'active'];

}
