<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageRecipient extends Model
{
    protected $fillable = ['message_id', 'mes_rec_id', 'mes_rec_type'];

    public $timestamps = false;


    public function messageRecipientables()
    {
        return $this->morphTo('mes_rec');
    }


    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'mes_rec_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'mes_rec_id');
    }
}
