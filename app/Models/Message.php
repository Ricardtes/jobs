<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['subject', 'body', 'sent'];


    public function messageRecipients()
    {
        return $this->hasMany(MessageRecipient::class,'message_id','id');
    }
}
