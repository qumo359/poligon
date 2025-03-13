<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * @var string[]
     *
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        // Категория имеет много постов
        return $this->hasMany(BlogPost::class, 'category_id'); // 'category_id' - внешний ключ в таблице blog_posts
    }

    /**
     * Пример аксессора
     *
     * @param string $valueFromObject
     *
     * @return array|false|string|string[]|null
     */
    public function getTitleAttribute($valueFromObject)
    {
        return mb_strtoupper($valueFromObject);
    }

    /**
     * Пример мутатора
     *
     * @param $incomingValue
     *
     * @return void
     */
    public function setTitleAttribute($incomingValue)
    {
        $this->attributes['title'] = mb_strtolower($incomingValue);
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


    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function title() :Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }
}
