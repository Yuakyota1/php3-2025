<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeColor extends Model
{
    protected $table = 'product_size_colors'; // Đúng tên bảng
    protected $fillable = ['idProduct', 'color', 'idSize', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'idSize', 'id');
    }
}

