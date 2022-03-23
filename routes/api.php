<?php

use App\Http\Controllers\api\MainController;
use App\Http\Controllers\api\AuthClientController;
use App\Http\Controllers\api\AuthResturantController;
use App\Http\Controllers\api\MainClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//general webservice (MainController)
Route::group([],function(){

    Route::get('/cities',[MainController::class ,'cities']);
    Route::get('/returants',[MainController::class ,'returants']);
    Route::get('/offers',[MainController::class ,'offers']);
    Route::get('/clients',[MainController::class ,'clients']);
    Route::get('/orders',[MainController::class ,'orders']);
    Route::get('/meals',[MainController::class ,'meals']);
    Route::get('/settings',[MainController::class ,'settings']);
    Route::get('/payments',[MainController::class ,'payments']);
    Route::get('/contact-us',[MainController::class ,'contactUs']);
    Route::get('/neighborhoods',[MainController::class ,'neighborhoods']);
    Route::get('/reviews',[MainController::class ,'reviews']);
    Route::get('/categories',[MainController::class ,'categories']);
});

//AuthClientController
Route::group([],function(){
    Route::post('/register',[AuthClientController::class,'register']);
    Route::post('/login',[AuthClientController::class,'login']);
    Route::post('/forget-password',[AuthClientController::class,'forgetPassword']);
    Route::post('/reset-password',[AuthClientController::class,'resetPassword']);
});

//clientLogin
Route::group(['middleware'=>'auth:client'],function(){
    Route::post('register-token',[AuthClientController::class,'registerToken']);
    Route::post('remove-token',[AuthClientController::class,'removeToken']);
    Route::put('edit-profile',[AuthClientController::class,'editProfile']);
    Route::post('create-order',[MainClientController::class,'orderCreate']);
    Route::get('client-orders',[MainClientController::class,'clientOrders']);
    Route::Post('decline-order',[MainClientController::class,'declineOrder']);
    Route::Post('delivered-order',[MainClientController::class,'deliveredOrder']);
    Route::get('notifications',[MainClientController::class,'notifications']);
    Route::Post('review-create',[MainClientController::class,'reviewCreate']);









});



//AuthResturantController
Route::group([],function(){
    Route::post('/register-resturant',[AuthResturantController::class,'register']);
    Route::post('/login-resturant',[AuthResturantController::class,'login']);
    Route::post('/forget-password-resturant',[AuthResturantController::class,'forgetPassword']);
    Route::post('/reset-password-resturant',[AuthResturantController::class,'resetPassword']);
});

//resturantLogin
Route::group(['middleware'=>'auth:resturant'],function(){
    Route::post('register-token',[AuthResturantController::class,'registerToken']);
    Route::post('remove-token',[AuthResturantController::class,'removeToken']);
    Route::post('offer-create',[AuthResturantController::class,'offerCreate']);
    Route::put('offer-edit',[AuthResturantController::class,'offerEdit']);
    Route::delete('offer-delete',[AuthResturantController::class,'offerDelete']);
    Route::post('meal-create',[AuthResturantController::class,'mealCreate']);
    Route::put('meal-edit',[AuthResturantController::class,'mealEdit']);
    Route::delete('meal-delete',[AuthResturantController::class,'mealDelete']);
    Route::post('order-accept',[AuthResturantController::class,'orderAccept']);
    Route::post('order-reject',[AuthResturantController::class,'orderReject']);
    Route::get('orders',[AuthResturantController::class,'orders']);
    Route::get('notifications',[AuthResturantController::class,'notifications']);
    Route::get('reviews',[AuthResturantController::class,'reviews']);






});




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
