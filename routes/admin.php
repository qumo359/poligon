<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Blog\Admin\CategoryController;
// use App\Http\Controllers\Blog\Admin\ImageUploadController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Middleware\AdminCheck;
use Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Blog\BlogCategoryController; // Импортируйте контроллер

//>Админка блога
$groupData = [
    //   'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group(['prefix' => 'admin/blog', 'as' => 'admin.', 'middleware' => 'admin'], function () { // Группа маршрутов для админ-панели (с middleware admin)
    Route::resource('categories', \App\Http\Controllers\Blog\Admin\CategoryController::class)->names('categories'); // Ресурсные маршруты для админских категорий
    Route::resource('posts', \App\Http\Controllers\Blog\Admin\PostController::class)->names('posts'); // Ресурсные маршруты для админских постов
    Route::post('/blog/posts/{post}', [PostController::class, 'storeTest'])->name('blog.update'); //  Вероятно, лишние маршруты, дублируют resource routes
    Route::post('/blog/posts2222/{post}', [PostController::class, 'storeTest2'])->name('admins.blog.update'); //  Вероятно, лишние маршруты, дублируют resource routes
});

//Route::group($groupData, function () {
//
//    Route::group(['middleware' => ['admin']], function () {
//        route::resource('posts', Blog\Admin\PostController::class)
//            ->except(['show'])
//            ->names('blog.admin.posts');
//
//
//        $methods = ['index', 'create', 'store', 'edit', 'update'];
//        Route::resource('categories', CategoryController::class)
//            ->only($methods)
//            ->names('blog.admin.categories');
//
//
//    });
//});
//
//Route::get('/', [Blog\PostController::class, 'index'])
//    ->name('blog.admin.posts.index');
//
//Route::get('/admin/blog/posts/{post}/restore', [Blog\Admin\PostController::class, 'restore'])
//    ->name('blog.admin.posts.restore');
//
//
//Route::get('/asdasdasd', function () {
//    return 1111;
//})->name('admin.dashboard');
//
