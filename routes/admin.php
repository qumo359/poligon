<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Blog\Admin\CategoryController;

// use App\Http\Controllers\Blog\Admin\ImageUploadController;
use App\Http\Controllers\Blog\Admin\UsersController;
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
use App\Http\Controllers\Blog\BlogCategoryController;

// Импортируйте контроллер

//>Админка блога
$groupData = [
    //   'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group(['prefix' => 'admin/blog', 'as' => 'admin.', 'middleware' => 'admin'], function () { // Группа маршрутов для админ-панели (с middleware admin)
    Route::resource('categories', \App\Http\Controllers\Blog\Admin\CategoryController::class)->names('categories'); // Ресурсные маршруты для админских категорий
//    Route::resource('users', \App\Http\Controllers\Blog\Admin\UsersController::class)->names('users');
    Route::get('/users', [\App\Http\Controllers\Blog\Admin\UsersController::class, 'index'])->name('users.index');
    Route::put('/blog/posts/{post}', [Admin\PostController::class, 'update'])->name('blog.update');
    Route::resource('posts', \App\Http\Controllers\Blog\Admin\PostController::class)->names('posts'); // Ресурсные маршруты для админских постов
    // Маршруты для редактирования и удаления пользователей
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Blog\Admin\UsersController::class, 'edit'])->name('users.edit'); // Форма редактирования пользователя
    Route::put('/users/{user}', [\App\Http\Controllers\Blog\Admin\UsersController::class, 'update'])->name('users.update'); // Обновление данных пользователя (PUT запрос)
    Route::delete('/users/{user}', [\App\Http\Controllers\Blog\Admin\UsersController::class, 'destroy'])->name('users.destroy'); // Удаление пользователя (DELETE запрос)

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
