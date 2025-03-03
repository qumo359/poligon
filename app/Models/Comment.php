<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\BlogPost;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Связь с моделью Post (многие к одному)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(): BelongsTo // Явно указываем тип BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }

    /**
     * Связь с моделью User (многие к одному)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo // Явно указываем тип BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
