<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookmarksController;
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

Auth::routes([
    'verify' => true
]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Route::post('/them-the-loai',[TestController::class,'themtheloai']);

Route::post('/them-the-loai',[CategoriesController::class,'store'])->name('Categories.store');
Route::get('/danh-sach-the-loai',[CategoriesController::class,'index'])->name('Categories.index');
Route::post('/sua-the-loai/{id}',[CategoriesController::class,'update'])->name('Categories.update');
Route::get('/chi-tiet-the-loai/{id}',[CategoriesController::class,'show'])->name('Categories.show');


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
// Route::resource('/Categories', CategoriesController::class);
// Route::resource('/User', UserController::class);
Route::resource('/Novel', NovelController::class);
Route::resource('/Chapter', ChapterController::class);
Route::resource('/Bookmark', BookmarksController::class);
// Route::resource('/Author', AuthorController::class);

Route::get('/Xoa-danh-dau/{id}',[BookmarksController::class,'bookmark_remove'])->name('Bookmark.bookmark_remove');

Route::get('/Chi-tiet-chuong-tacgia/{id}',[ChapterController::class,'page_chitiet_chuong_author'])->name('Chapter.page_chitiet_chuong_author');
Route::get('/Chi-tiet-chuong-kiemduyet/{id}',[ChapterController::class,'admin_kiemquyet_chuong'])->name('Chapter.admin_kiemquyet_chuong');
Route::post('/Ketqua-kiem-duyet-chuong-truyen',[ChapterController::class,'kiem_duyet_chuong'])->name('Chapter.kiem_duyet_chuong');
Route::get('/Xoa-lich-su-doc/{id}',[ChapterController::class,'xoa_lichsu_doc'])->name('Chapter.xoa_lichsu_doc');
Route::get('/Mua-chuong/{id}',[ChapterController::class,'mua_chuong'])->name('Chapter.mua_chuong');

Route::post('/Danh-sachtruyen-tacgia',[NovelController::class,'Danh_sachtruyen_tacgia'])->name('Novel.Danh_sachtruyen_tacgia');
Route::get('/Quan-ly-truyen/{id}',[NovelController::class,'quan_ly_truyen'])->name('Novel.quan_ly_truyen');
Route::get('/Danh_sach_truyen',[NovelController::class,'danhsach_xetduyet'])->name('Novel.danhsach_xetduyet');
Route::post('/Xet-duyet-ban-quyen-truyen/{id}',[NovelController::class,'xetduyet'])->name('Novel.xetduyet');
Route::get('/Chi-tiet-truyen/{id}',[NovelController::class,'chi_tiet_truyen'])->name('Novel.chi_tiet_truyen');
Route::get('/Kiem-duyet-chuong-truyen/{id}',[NovelController::class,'page_kiem_duyet_chuong'])->name('Novel.page_kiem_duyet_chuong');



Route::post('/them-thong-tin-tac-gia',[AuthorController::class,'store'])->name('Author.store');
Route::get('/xem-thong-tin-tac-gia/{id}',[AuthorController::class,'show'])->name('Author.show');
Route::post('/cap-nhat-thong-tin-tac-gia/{id}',[AuthorController::class,'update'])->name('Author.update');
Route::post('/xet-duyet-tac-gia/{id}',[AuthorController::class,'xetduyet'])->name('Author.xetduyet');
Route::post('/chi-tiet-tac-gia/{id}',[AuthorController::class,'edit'])->name('Author.edit');
Route::get('/danh-sach-xet-duyet-tac-gia',[AuthorController::class,'danhsach_xetduyet'])->name('Author.danhsach_xetduyet');

Route::get('/User/{id}/admin', [UserController::class, 'admin'])->name('User.admin');
Route::post('/User-update/{id}', [UserController::class, 'update'])->name('User.update');
Route::get('/User/{id}/show', [UserController::class, 'show'])->name('User.show');
Route::post('/update-anhdaidien/{id}', [UserController::class, 'update_anhdaidien'])->name('User.update_anhdaidien');
Route::post('/User-setting/{id}', [UserController::class, 'save_user_setting'])->name('User.save_user_setting');
Route::get('/User-list', [UserController::class, 'danh_sach_user'])->name('User.danh_sach_user');
Route::post('/User-cap-quyen/{id_user}', [UserController::class, 'cap_quyen_user'])->name('User.cap_quyen_user');
Route::post('/User-khoa-tai-khoan/{id_user}', [UserController::class, 'khoa_user'])->name('User.khoa_user');
Route::post('/User-lhoa-binhluan/{id_user}', [UserController::class, 'khoa_comment_user'])->name('User.khoa_comment_user');

Route::post('/Nap-tien', [BillController::class, 'Naptien'])->name('Bill.Naptien');
Route::get('/Nap-tien-thanh-cong/{id}', [BillController::class, 'Naptienthanhcong'])->name('Bill.Naptienthanhcong');