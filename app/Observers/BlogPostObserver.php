<?php

namespace App\Observers;

use App\Models\BlogPost;

class BlogPostObserver
{
    /**
     * Обработка ПЕРЕД созданием записи
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function creating(BlogPost $blogPost): void
    {
        /*$this->setPublishedAt($blogPost);

     $this->setSlug($blogPost);*/
    }

    /**
     * Обработка ПЕРЕД обновлением записи
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function updating(BlogPost $blogPost): void
    {
        $this->setPublishedAt($blogPost);

    }

    /**
     * Если дата публикации не установлена и приходит установка флага - Опубликовано,
     * то устанавливаем дату публикации на текущую.
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        $isNeedSetPublished = empty($blogPost->published_at) && $blogPost->is_published;
        if ($isNeedSetPublished) {
            $blogPost->published_at = now();
        }
    }

    /**
     * Если поле слаг пустое, то заполняем его конвертацией заголовка.
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }

    /**
     * Handle the BlogPost "created" event.
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function created(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "updated" event.
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function updated(BlogPost $blogPost): void
    {

    }

    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function deleted(BlogPost $blogPost): void
    {
        //
    }


    /**
     * Handle the BlogPost "restored" event.,
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function restored(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "forceDeleted" event.
     *
     * @param \App\Models\BlogPost $blogPost
     *
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }
}
