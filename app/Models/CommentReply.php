<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'user_id', 'content', 'image', 'rating'];

    // Mối quan hệ với comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // Mối quan hệ với user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
{
    return $this->belongsTo(CommentReply::class, 'parent_reply_id');
}

public function children()
{
    return $this->hasMany(CommentReply::class, 'parent_reply_id');
}


}
