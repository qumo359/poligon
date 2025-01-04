<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\RestTestController;
use Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'blog'], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});


//>Админка блога
$groupData = [
 //   'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group($groupData, function () {
    //BlogCategory
    $methods = ['index', 'create', 'store', 'edit', 'update'];
    Route::resource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');

    //BlogPost
    route::resource('posts', Blog\Admin\PostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});
//<



//Route::resource('rest', RestTestController::class)->names('restTest');


