<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeProfile extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contact',
        'logo',
        'opening_hours'
    ];

    protected $casts = [
        'opening_hours' => 'array',
    ];
}