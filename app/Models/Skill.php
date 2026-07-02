<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'category',
        'name',
        'description',
        'level',
        'icon',
        'featured',
        'proficiency',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'proficiency' => 'integer',
        'featured' => 'boolean'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
