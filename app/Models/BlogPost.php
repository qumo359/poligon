<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @class  BlogPost
 *
 * @package App\Models
 *
 * @property \App\Models\BlogCategory $category
 * @property \App\Models\User $user
 * @property string $title
 * @property string $slug
 * @property string $content_html
 * @property string $content_raw
 * @property string $excerpt
 * @property string $published_at
 * @property boolean $is_published
 */
class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content_raw',
        'excerpt',
        'published_at',
        'is_published',
    ];

    /**
     * Категория статьи
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        //Статья принадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Автор статьи
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //Статья принадлежит пользователю
        return $this->belongsTo(User::class);
    }
}
