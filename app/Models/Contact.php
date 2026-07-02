<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'primary_email',
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
