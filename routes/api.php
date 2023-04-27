<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//--- Login --- Register ---- Logout --- Changepass --- User profile
Route::post('user/register',[\App\Http\Controllers\UserController::class,'register']);
Route::post('user/login',[\App\Http\Controllers\UserController::class,'login']);

Route::resource('user',\App\Http\Controllers\UserController::class);

Route::resource('category',\App\Http\Controllers\CategoryController::class);

Route::resource('publisher',\App\Http\Controllers\PublisherController::class);

Route::resource('product',\App\Http\Controllers\ProductController::class);
//get by category name
Route::post('product/getbycat',[\App\Http\Controllers\ProductController::class,'getbycat']);
// get by publisher name
Route::post('product/getbypublisher',[\App\Http\Controllers\ProductController::class,'getbypublisher']);

Route::resource('oder',\App\Http\Controllers\OderController::class);
//get by user name
Route::resource('detailoders',\App\Http\Controllers\DetailsOderController::class);

Route::resource('detailproduct',\App\Http\Controllers\DetailsProductController::class);

Route::resource('images',\App\Http\Controllers\ImagesController::class);


