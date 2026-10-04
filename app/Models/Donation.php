<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'amount',
        'purpose',
        'message',
        'city',
        'transaction_id',
        'status',
        'address'
    ];

    protected $casts = [
        'anonymous' => 'boolean',
        'amount'    => 'decimal:2',
    ];

    protected $attributes = [
        'status'    => 'completed',
        'anonymous' => false,
    ];
}
