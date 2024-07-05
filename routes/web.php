<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AuthorController;
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
// Route::resource('/Author', AuthorController::class);

Route::post('/Danh-sachtruyen-tacgia',[NovelController::class,'Danh_sachtruyen_tacgia'])->name('Novel.Danh_sachtruyen_tacgia');
Route::get('/Quan-ly-truyen/{id}',[NovelController::class,'quan_ly_truyen'])->name('Novel.quan_ly_truyen');

Route::post('/them-thong-tin-tac-gia',[AuthorController::class,'store'])->name('Author.store');
Route::get('/xem-thong-tin-tac-gia/{id}',[AuthorController::class,'show'])->name('Author.show');
Route::post('/cap-nhat-thong-tin-tac-gia/{id}',[AuthorController::class,'update'])->name('Author.update');
Route::post('/xet-duyet-tac-gia/{id}',[AuthorController::class,'xetduyet'])->name('Author.xetduyet');
Route::post('/chi-tiet-tac-gia/{id}',[AuthorController::class,'edit'])->name('Author.edit');
Route::post('/danh-sach-xet-duyet-tac-gia',[AuthorController::class,'danhsach_xetduyet'])->name('Author.danhsach_xetduyet');

Route::get('/User/{id}/admin', [UserController::class, 'admin'])->name('User.admin');
Route::post('/User-update/{id}', [UserController::class, 'update'])->name('User.update');
Route::get('/User/{id}/show', [UserController::class, 'show'])->name('User.show');
Route::post('/update-anhdaidien/{id}', [UserController::class, 'update_anhdaidien'])->name('User.update_anhdaidien');

Route::post('/Nap-tien', [BillController::class, 'Naptien'])->name('Bill.Naptien');
Route::get('/Nap-tien-thanh-cong/{id}', [BillController::class, 'Naptienthanhcong'])->name('Bill.Naptienthanhcong');