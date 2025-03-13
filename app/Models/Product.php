<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable = ['product_name', 'description', 'images', 'sub_category_id'];

    protected $casts = [
        'images' => 'array', // Convert JSON sang mảng PHP
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
