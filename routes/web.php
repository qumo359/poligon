<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Blog\Admin\CategoryController;
// use App\Http\Controllers\Blog\Admin\ImageUploadController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\LikeController;
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


Route::get('blog/categories/{category:slug}', [BlogCategoryController::class, 'show'])->name('blog.categories.show');

Route::post('/admin/blog/posts/{post}', [Blog\Admin\PostController::class, 'storeTest'])->name('blog.update');
Route::post('/admin/blog/posts2222/{post}', [Blog\Admin\PostController::class, 'storeTest2'])->name('admins.blog.update');



// Форма регистрации и обработка данных
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Форма входа и обработка данных
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Выход из системы
//Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Сброс пароля (форма ввода email)
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Сброс пароля (форма ввода нового пароля)
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


//Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image-upload');

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');
});

Route::group(['prefix' => 'blog'], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});






// Маршрут для добавления комментария
Route::post('/blog/posts{post}', [CommentController::class, 'store'])->name('blog.posts.comments.store');
Route::get('/search', [PostController::class, 'search'])->name('blog.search');


require __DIR__ . '/admin.php';
//Route::resource('rest', RestTestController::class)->names('restTest');

Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('blog.posts.like');
Route::post('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('blog.posts.unlike');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
