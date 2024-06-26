<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Route::post('/them-the-loai',[TestController::class,'themtheloai']);

Route::post('/them-the-loai',[CategoriesController::class,'store'])->name('Categories.store');
Route::post('/danh-sach-the-loai',[CategoriesController::class,'index'])->name('Categories.index');
Route::post('/sua-the-loai/{id}',[CategoriesController::class,'update'])->name('Categories.update');
Route::post('/chi-tiet-the-loai/{id}',[CategoriesController::class,'show'])->name('Categories.show');


Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::resource('/Categories', CategoriesController::class);
// Route::resource('/User', UserController::class);
Route::resource('/Novel', NovelController::class);
Route::resource('/Chapter', ChapterController::class);

Route::get('/User/{id}/admin', [UserController::class, 'admin'])->name('User.admin');
Route::post('/User-update/{id}', [UserController::class, 'update'])->name('User.update');
Route::get('/User/{id}/show', [UserController::class, 'show'])->name('User.show');

