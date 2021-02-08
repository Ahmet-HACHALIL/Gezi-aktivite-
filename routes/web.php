<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservedplaceController;
use App\Http\Controllers\SightseeingPlaceController;
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
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/sendmessage', [HomeController::class, 'sendmessage'])->name('sendmessage');
Route::get('/sightseeing_place/{id}/{slug}', [HomeController::class, 'sightseeing_place'])->name('sightseeing_place');
Route::get('/tour_sightseeing_places/{id}/{slug}', [HomeController::class, 'tour_sightseeing_places'])->name('tour_sightseeing_places');
#Route::post('/get_sightseeing_place', [HomeController::class, 'get_sightseeing_place'])->name('get_sightseeing_place');


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

    #Messages
    Route::prefix('messages')->group(function () {
        //Route assigned name "admin.users"...
        Route::get('/', [MessageController::class, 'index'])->name('admin_message');
        Route::get('edit/{id}', [MessageController::class, 'edit'])->name('admin_message_edit');
        Route::post('update/{id}', [MessageController::class, 'update'])->name('admin_message_update');
        Route::get('delete/{id}', [MessageController::class, 'destroy'])->name('admin_message_delete');
        Route::get('show', [MessageController::class, 'show'])->name('admin_message_show');
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

    #Faq
    Route::prefix('faq')->group(function () {
        //Route assigned name "admin.users"...
        Route::get('/', [FaqController::class, 'index'])->name('admin_faq');
        Route::get('create', [FaqController::class, 'create'])->name('admin_faq_add');
        Route::post('store', [FaqController::class, 'store'])->name('admin_faq_store');
        Route::get('edit/{id}', [FaqController::class, 'edit'])->name('admin_faq_edit');
        Route::post('update/{id}', [FaqController::class, 'update'])->name('admin_faq_update');
        Route::get('delete/{id}', [FaqController::class, 'destroy'])->name('admin_faq_delete');
        Route::get('show', [FaqController::class, 'show'])->name('admin_faq_show');
    });


});

#user
Route::middleware('auth')->prefix('myaccount')->namespace('myaccount')->group(function (){
    Route::get('/', [UserController::class, 'index'])->name('myprofile');
});

#user
Route::middleware('auth')->prefix('user')->namespace('user')->group(function (){
    Route::get('user/profile', [UserController::class, 'index'])->name('userprofile');

    #Sightseeing_Places
    Route::prefix('Sightseeing_Places')->group(function () {
        //Route assigned name "admin.users"...
        Route::get('/', [SightseeingPlaceController::class, 'index'])->name('user_sightseeing_place');
        Route::get('create', [SightseeingPlaceController::class, 'create'])->name('user_sightseeing_place_add');
        Route::post('store', [SightseeingPlaceController::class, 'store'])->name('user_sightseeing_place_store');
        Route::get('edit/{id}', [SightseeingPlaceController::class, 'edit'])->name('user_sightseeing_place_edit');
        Route::post('update/{id}', [SightseeingPlaceController::class, 'update'])->name('user_sightseeing_place_update');
        Route::get('delete/{id}', [SightseeingPlaceController::class, 'destroy'])->name('user_sightseeing_place_delete');
        Route::get('show', [SightseeingPlaceController::class, 'show'])->name('user_sightseeing_place_show');
    });

    #Sightseeing_Places image gallery
    Route::prefix('image')->group(function () {
        Route::get('create/{sightseeing_places_id}', [ImageController::class, 'create'])->name('user_image_add');
        Route::post('store/{sightseeing_places_id}', [ImageController::class, 'store'])->name('user_image_store');
        Route::get('delete/{id}/{sightseeing_places_id}', [ImageController::class, 'destroy'])->name('user_image_delete');
        Route::get('show', [ImageController::class, 'show'])->name('admin_image_show');
    });

    #ReservedPlaces
    Route::prefix('reservedplace')->group(function () {
        //Route assigned name "admin.users"...
        Route::get('/', [ReservedplaceController::class, 'index'])->name('user_reservedplace');
        Route::post('store/{id}', [ReservedplaceController::class, 'store'])->name('user_reservedplace_add');
        Route::post('update/{id}', [ReservedplaceController::class, 'update'])->name('user_reservedplace_update');
        Route::get('delete/{id}', [ReservedplaceController::class, 'destroy'])->name('user_reservedplace_delete');
    });

});

//login
Route::get('/admin/login', [HomeController::class, 'login'])->name('admin_login');
Route::post('/admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
