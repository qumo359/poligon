<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Blog\Admin\CategoryController;
// use App\Http\Controllers\Blog\Admin\ImageUploadController;
use App\Http\Controllers\Blog\PostController;
use Auth;
use Illuminate\Support\Facades\Route;

Route::post('/admin/blog/posts/{post}', [Blog\Admin\PostController::class, 'storeTest'])->name('blog.update');
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image-upload');

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');
});

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

Route::get('/admin/blog/posts/{post}/restore', [Blog\Admin\PostController::class, 'restore'])
    ->name('blog.admin.posts.restore');

//<


//Route::resource('rest', RestTestController::class)->names('restTest');


