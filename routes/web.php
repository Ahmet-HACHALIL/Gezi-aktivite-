<?php

use App\Http\Controllers\HomeController;
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

Route::get('/home1', function () {
    return view('welcome');
});
Route::redirect('/anasayfa', '/home')->name('anasayfa');

Route::get('/', function () {
    return view('home.index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');

//Route::get('/test/{id}/{name}', [HomeController::class, 'test'])->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);
Route::get('/test/{id}/{name}', [HomeController::class, 'test'])->whereNumber('id')->whereAlpha('name')->name('test');

//Admin
Route::middleware('auth')->prefix('admin')->group(function (){

    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_home');

    Route::get('tour', [\App\Http\Controllers\Admin\TurlarController::class, 'index'])->name('admin_turlar');
    Route::get('tour/add', [\App\Http\Controllers\Admin\TurlarController::class, 'add'])->name('admin_turlar_add');
    Route::post('tour/create', [\App\Http\Controllers\Admin\TurlarController::class, 'create'])->name('admin_turlar_create');
    Route::post('tour/update', [\App\Http\Controllers\Admin\TurlarController::class, 'update'])->name('admin_turlar_update');
    Route::get('tour/delete/{id}', [\App\Http\Controllers\Admin\TurlarController::class, 'destroy'])->name('admin_turlar_delete');
    Route::get('tour/show', [\App\Http\Controllers\Admin\TurlarController::class, 'show'])->name('admin_turlar_show');

});

//login
Route::get('/admin/login', [HomeController::class, 'login'])->name('admin_login');
Route::post('/admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
Route::get('/admin/logout/', [HomeController::class, 'logout'])->name('admin_logout');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
