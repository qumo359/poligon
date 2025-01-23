<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    /**
     * Базовая инф.
     * https://laravel.com/docs/11.x/collections
     *
     * Справочная инф.
     * https://laravel.com/api/11.x/Illuminate/Support/Collection.html
     *
     * Вариант коллекции для модели Eloquent
     * https://laravel.com/api/11.x/Illuminate/Database/Eloquent/Collection.html
     *
     */
    public function collections()
    {
        $result = [];

        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();

//        dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());

        dd(
            get_class($eloquentCollection),
            get_class($collection),
            $collection
        );
    }
}
