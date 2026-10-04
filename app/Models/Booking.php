<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_name',
        'email',
        'phone',
        'visit_date',
        'visit_time',
        'num_visitors',
        'purpose',
        'special_request',
        'status',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];
}
