<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'discount',
        'usage_limit',
        'used_count',
        'expiry_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'discount' => 'decimal:2',
            'expiry_date' => 'date',
            'status' => 'boolean',
        ];
    }
}
