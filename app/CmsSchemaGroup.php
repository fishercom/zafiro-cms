<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSchemaGroup extends Model
{
	protected $table = 'cms_schema_groups';
	protected $fillable = ['name', 'layout', 'default', 'active'];

}
