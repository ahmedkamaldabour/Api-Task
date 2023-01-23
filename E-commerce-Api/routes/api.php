<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::post('register', [AuthController::class, 'register']);
//Route::post('login', [AuthController::class, 'login']);

// Auth routes
Route::controller(AuthController::class)->group(function () {
	Route::post('login', 'login');
	Route::post('register', 'register');
//	Route::post('logout', 'logout');
//	Route::post('refresh', 'refresh');
});

// products routes
Route::controller(ProductsController::class)->group(function () {
	Route::get('products', 'index');
	Route::get('products/{id}', 'show');
	Route::post('products', 'store');
	Route::put('products/{id}', 'update');
	Route::delete('products/{id}', 'destroy');
});

// cart routes
Route::controller(CartController::class)->group(function () {
	Route::get('cart', 'userCart');
	Route::post('cart', 'addToCart');
	Route::delete('cart', 'deleteFromCart');
	Route::put('cart', 'updateCart');
});