<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = 'messages';
	protected $fillable = ['member_id', 'sender_id', 'subject', 'message', 'metadata', 'read', 'trash'];

    public function setMetadataAttribute($value)
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    public function getMetadataAttribute($value)
    {
        return json_decode($value, true);
    }

}
