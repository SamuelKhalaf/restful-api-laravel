<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'checkApiLanguage'] , function (){

    Route::post('login' , [LoginController::class,'login']);

});

Route::group(['middleware' => ['checkApiLanguage','auth:sanctum']] , function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/setting' , [SettingController::class,'index']);
    Route::get('/categories' , [CategoriesController::class,'index']);

    Route::post('logout' , [LoginController::class,'logout']);

});
