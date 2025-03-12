<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RayonController;


Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [UserAuthController::class, 'logout']);
Route::post('admin/login', [UserAuthController::class, 'adminLogin']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('categories', CategorieController::class);
Route::apiResource('rayons', RayonController::class);