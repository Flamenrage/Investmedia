<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [HomeController::class, 'show'])->name('posts.single');
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.single');
Route::get('/tag/{slug}', [App\Http\Controllers\TagController::class, 'show'])->name('tags.single');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/convert', [App\Http\Controllers\CurrencyRateController::class, 'index'])->name('converter.index');
Route::post('/convert', [App\Http\Controllers\CurrencyRateController::class, 'convert'])->name('converter.convert');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('categories', '\App\Http\Controllers\Admin\CategoryController'); //отвечает на /create, /edit, /update и тд
    Route::resource('tags', '\App\Http\Controllers\Admin\TagController'); //отвечает на /create, /edit, /update и тд
    Route::resource('posts', '\App\Http\Controllers\Admin\PostController'); //отвечает на /create, /edit, /update и тд
    Route::get('/posts/sort-categories/{slug}', [\App\Http\Controllers\Admin\PostController::class, 'sortByCategory'])->name('admin.sortByCategory');
    Route::get('/search', [\App\Http\Controllers\Admin\SearchController::class, 'index'])->name('admin.search');
    Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('admin.comments');
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'getUserList'])->name('admin.users');


    //https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.create'); //создаем и открываем форму
    Route::post('/register', [UserController::class, 'store'])->name('register.store'); //сохраняем и отправляем данные с формы
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create'); //создаем и открываем форму
    Route::post('/login', [UserController::class, 'login'])->name('login'); //сохраняем и отправляем (принимаем) данные с формы
}); //разрешаем переходить на эти страницы для гостя

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('login.logout'); //выйти из кабинета
    Route::resource('comments', 'App\Http\Controllers\CommentController'); //отвечает на /create, /edit, /update и тд
    Route::get('/account', [UserController::class, 'account'])->name('user.account'); //личный кабинет
    Route::get('/update', [UserController::class, 'getData'])->name('user.update');
    Route::put('/update', [UserController::class, 'updateData'])->name('user.save');

});


