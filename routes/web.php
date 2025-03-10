<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Blog\Admin\CategoryController as AdminCategoryController; // Более явное имя для Admin CategoryController
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController; // Более явное имя для Admin PostController
// use App\Http\Controllers\Blog\Admin\ImageUploadController; // Закомментировано, возможно не используется
use App\Http\Controllers\Blog\BlogCategoryController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\DiggingDeeperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\LikeController;
use \App\Http\Controllers\Blog\Admin;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (отдельная группа для маршрутов аутентификации)
Route::group(['as' => 'auth.'], function () { // Добавляем 'as' => 'auth.' для группировки имен маршрутов аутентификации
    // Registration Routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post'); // Уточняем имя для POST маршрута регистрации

    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post'); // Уточняем имя для POST маршрута входа

    // Password Reset Routes
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Logout Route (теперь будет POST формой, как и должно быть - в другом месте, например в layouts/app.blade.php)
    // Route::post('/logout', [LogoutController::class, 'logout'])->name('logout'); // Маршрут Logout обычно определяется в Auth::routes(); или вручную в форме POST
});


Route::get('/home', [HomeController::class, 'index'])->name('home'); // Главная страница пользователя (dashboard) - вне группы auth, т.к. может иметь свою логику middleware


Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image-upload'); // Маршрут для загрузки изображений (вне группы блога, т.к. может быть общим)

Route::group(['prefix' => 'digging_deeper', 'as' => 'digging_deeper.'], function () { // Группа маршрутов для "погружения"
    Route::get('collections', [DiggingDeeperController::class, 'collections'])->name('collections');
});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () { // Группа маршрутов для блога
    Route::resource('categories', BlogCategoryController::class)->only(['index', 'show'])->names('categories'); // Ресурсные маршруты для категорий (только index и show)
    Route::get('/categories/{category:slug}', [BlogCategoryController::class, 'show'])->name('categories.show'); // Повторно определен, можно удалить, если resource route уже покрывает show

    Route::resource('posts', PostController::class)->names('posts'); // Ресурсные маршруты для постов
    Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search'); // Маршрут для поиска постов

    // Comment Routes (маршруты для комментариев)
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');

    // Like Routes (маршруты для лайков)
    Route::post('/posts/{blogPost}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::post('/posts/{blogPost}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
});




require __DIR__ . '/admin.php'; // Подключение внешнего файла admin.php - если нужно, оставьте, но проверьте его содержимое
//Route::resource('rest', RestTestController::class)->names('restTest'); // Закомментированный resource route - возможно устарел или не используется

Auth::routes(); // Маршруты аутентификации Laravel (регистрация, вход, сброс пароля, выход - **уже определены выше, эту строку можно удалить**)
