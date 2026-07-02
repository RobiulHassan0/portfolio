<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'thumbnail',
        'live_url',
        'github_url',
        'tech_stack',
        'featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
