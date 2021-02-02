<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::redirect('/anasayfa', '/home')->name('anasayfa');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('homepage');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/references', [HomeController::class, 'references'])->name('references');
Route::get('/fag', [HomeController::class, 'fag'])->name('fag');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//Route::get('/test/{id}/{name}', [HomeController::class, 'test'])->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);
Route::get('/test/{id}/{name}', [HomeController::class, 'test'])->whereNumber('id')->whereAlpha('name')->name('test');

//Admin
Route::middleware('auth')->prefix('admin')->group(function (){

    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_home');
    #Tours
    Route::get('tour', [\App\Http\Controllers\Admin\TurlarController::class, 'index'])->name('admin_turlar');
    Route::get('tour/add', [\App\Http\Controllers\Admin\TurlarController::class, 'add'])->name('admin_turlar_add');
    Route::post('tour/create', [\App\Http\Controllers\Admin\TurlarController::class, 'create'])->name('admin_turlar_create');
    Route::get('tour/edit/{id}', [\App\Http\Controllers\Admin\TurlarController::class, 'edit'])->name('admin_turlar_edit');
    Route::post('tour/update/{id}', [\App\Http\Controllers\Admin\TurlarController::class, 'update'])->name('admin_turlar_update');
    Route::get('tour/delete/{id}', [\App\Http\Controllers\Admin\TurlarController::class, 'destroy'])->name('admin_turlar_delete');
    Route::get('tour/show', [\App\Http\Controllers\Admin\TurlarController::class, 'show'])->name('admin_turlar_show');

    #Sightseeing_Places
    Route::prefix('Sightseeing_Places')->group(function () {
        //Route assigned name "admin.users"...
        Route::get('/', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'index'])->name('admin_sightseeing_place');
        Route::get('create', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'create'])->name('admin_sightseeing_place_add');
        Route::post('store', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'store'])->name('admin_sightseeing_place_store');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'edit'])->name('admin_sightseeing_place_edit');
        Route::post('update/{id}', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'update'])->name('admin_sightseeing_place_update');
        Route::get('delete/{id}', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'destroy'])->name('admin_sightseeing_place_delete');
        Route::get('show', [\App\Http\Controllers\Admin\SightseeingPlacesController::class, 'show'])->name('admin_sightseeing_place_show');
    });

    #Sightseeing_Places image gallery
    Route::prefix('image')->group(function () {
        Route::get('create/{sightseeing_places_id}', [\App\Http\Controllers\Admin\ImageController::class, 'create'])->name('admin_image_add');
        Route::post('store/{sightseeing_places_id}', [\App\Http\Controllers\Admin\ImageController::class, 'store'])->name('admin_image_store');
        Route::get('delete/{id}/{sightseeing_places_id}', [\App\Http\Controllers\Admin\ImageController::class, 'destroy'])->name('admin_image_delete');
        Route::get('show', [\App\Http\Controllers\Admin\ImageController::class, 'show'])->name('admin_image_show');
    });

    #Setting
    Route::get('setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin_setting');
    Route::post('setting/update', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin_setting_update');

});

#user
Route::middleware('auth')->prefix('myaccount')->namespace('myaccount')->group(function (){
    Route::get('/', [UserController::class, 'index'])->name('myprofile');
});


//login
Route::get('/admin/login', [HomeController::class, 'login'])->name('admin_login');
Route::post('/admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
