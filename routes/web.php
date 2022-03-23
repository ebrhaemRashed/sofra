<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ResturantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;








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


//dashboard

Route::group(['middleware' =>['auth:user','auto-check']],function(){

    Route::get('/layout', function () {
        return view('dashboard.layout');
    })->name('home');

    Route::resource('/city',CityController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/neighborhood', NeighborhoodController::class);
    Route::resource('/payment', PaymentController::class);
    Route::resource('/offer', OfferController::class);
    Route::resource('/contact', ContactController::class);
    Route::resource('/setting', SettingController::class);
    Route::resource('/resturant', ResturantController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/role', RoleController::class);

});

 //


Route::get('login-page',[AuthController::class,'loginPage'])->name('loginPage')->middleware('guest:user');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('register-page',[AuthController::class,'registerPage'])->name('registerPage');
Route::post('register',[AuthController::class,'register'])->name('register');

Route::post('logout',[AuthController::class,'logout'])->name('logout');










