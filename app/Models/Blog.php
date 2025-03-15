<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'image', 'author_id', 'status', 'post_category_id']; // Thêm post_category_id

    // Tạo slug tự động
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }

    // Liên kết với user (tác giả)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Liên kết với danh mục bài viết
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
