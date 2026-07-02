<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'icon',
        'service_items',
        'category',
        'is_active',
        'featured',
        'sort_order'
    ];

    protected $casts = [
        'service_items' => 'array',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'featured' => 'boolean'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
