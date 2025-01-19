<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 *
 * @package App\Models
 *
 * @property-read BlogCategory @parentCategory
 * @property-read string       @parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    /**
     * Id корневой категории
     */
    const ROOT = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'title',
            'slug',
            'parent_id',
            'description',
        ];

    /**
     * Получить родительскую категорию.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    /**
     * Пример аксессора (Accsessor)
     *
     * @url https://laravel.com/docs/11.x/eloquent-mutators
     *
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
                ? 'Корень'
                : '???');

        return $title;
    }

    /**
     * Являеться ли текущий объект корневым
     *
     * @return bool
     */
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }
}
