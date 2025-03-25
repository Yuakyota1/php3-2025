<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    // Quan hệ: Một yêu thích thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ: Một yêu thích thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    
}
