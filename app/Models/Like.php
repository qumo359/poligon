<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blog_post_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Лайк принадлежит пользователю
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id'); // Лайк принадлежит посту (уточняем foreign key)
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class); // Лайк принадлежит пользователю
    }
}
