<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{  
    protected $fillable = ['subcategory_name', 'category_id'];

    // Liên kết danh mục con với danh mục cha
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
