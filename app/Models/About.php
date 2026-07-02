<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'highlights',
        'location',
        'workflow',
        'availability',
        'status',
        'image_path'
    ];

    protected $casts = [
        'highlights' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
