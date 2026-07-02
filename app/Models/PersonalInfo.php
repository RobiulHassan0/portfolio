<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $fillable = [
        'user_id',
        'designation',
        'bio',
        'profile_photo',
        'resume_url',
        'stack',
        'focus',
        'is_available',
        'availability_text'
    ];

    protected $casts = [
        'stack' => 'array',
        'is_available' => 'boolean'
    ];

    public function user(){
        return $this->belongsTo(User::class); 
    }
}
