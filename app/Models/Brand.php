<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không phải theo chuẩn
    protected $table = 'brands';

    // Các thuộc tính có thể gán đại chúng (mass assignable)
    protected $fillable = [
        'name',
        'description',
    ];
}
