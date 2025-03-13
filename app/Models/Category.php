<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['category_name'];

    // Liên kết danh mục cha với danh mục con
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
