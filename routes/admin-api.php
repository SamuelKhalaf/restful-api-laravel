<?php

use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Support\Facades\Route;


//api resources put,post,delete
Route::apiResource('category',CategoriesController::class)->except('index','show');
