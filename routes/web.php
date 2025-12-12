<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserBlogController;
use App\Http\Controllers\FavoriteController;
use App\Http\Middleware\AdminMiddleware;

//  الصفحة الرئيسية العامة
Route::get('/', function () {
    return view('users.home');
})->name('home');
//  صفحات المستخدم العادي
Route::prefix('users')->group(function () {
    // عرض كل المقالات
    Route::get('/blogs', [UserBlogController::class, 'index'])->name('users.blogs.index');

    // عرض تفاصيل مقالة
    Route::get('/blogs/{id}', [UserBlogController::class, 'show'])->name('users.blogs.show');
    Route::get('/blogs', [UserBlogController::class, 'afterFilter'])->name('users.blogs.index');

    // عرض المفضلة (يتطلب تسجيل دخول)
    Route::middleware('auth')->group(function () {
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites/{blog}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    });
   });
//  لوحة تحكم الأدمن
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('/home', [BlogController::class, 'home'])->name('admin.home');
         Route::get('/blogs/trashed', [BlogController::class, 'trashed'])->name('blogs.trashed');
        Route::put('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');
        Route::delete('/blogs/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blogs.forceDelete');
        Route::resource('blogs', BlogController::class)->except('show');
          Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
        Route::resource('categories', CategoryController::class);  
    });

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('admin/home', [BlogController::class, 'home'])->name('admin.home');
//  مسارات تسجيل الدخول والتسجيل
require __DIR__.'/auth.php';