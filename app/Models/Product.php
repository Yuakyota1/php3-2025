<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'description', 'images', 'sub_category_id', 'brand_id'];

    protected $casts = [
        'images' => 'array', // Chuyển cột JSON 'images' thành mảng PHP
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function sizeColors()
    {
        return $this->hasMany(ProductSizeColor::class, 'idProduct', 'id');
    }
    public function comments()
{
    return $this->hasMany(Comment::class, 'product_id', 'id');
}

}
