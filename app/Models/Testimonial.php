<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'message',
        'rating',
        'avatar',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
