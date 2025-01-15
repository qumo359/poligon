<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{

    /**
     * @param \App\Models\BlogCategory $blogCategory
     *
     * @return void
     */
    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Если поле слаг пустое - заполняет его конвертацией заголовка.
     *
     * @param \App\Models\BlogCategory $blogCategory
     *
     * @return void
     */
    protected function setSlug(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }

    /**
     * Handle the BlogCategory "created" event.
     */
    public function created(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * @param \App\Models\BlogCategory $blogCategory
     *
     * @return void
     */
    public function updatng(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the BlogCategory "updated" event.
     */
    public function updated(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "deleted" event.
     */
    public function deleted(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "restored" event.
     */
    public function restored(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "force deleted" event.
     */
    public function forceDeleted(BlogCategory $blogCategory): void
    {
        //
    }
}
