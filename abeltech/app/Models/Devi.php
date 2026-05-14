<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devi extends Model
{
    protected $table = 'devis';
    
    protected $fillable = [
        'name', 'email', 'phone', 'service', 'budget', 'deadline', 'description', 'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
