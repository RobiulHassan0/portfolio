<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'receiver_id',
        'sender_name',
        'sender_email',
        'subject',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
