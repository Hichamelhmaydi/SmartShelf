<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CategorieController;


Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [UserAuthController::class, 'logout']);
Route::post('admin/login', [UserAuthController::class, 'adminLogin']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('categorie', [CategorieController::class, 'store']);
Route::get('categories', [CategorieController::class, 'index']);
Route::put('categorie/{categorie}', [CategorieController::class, 'update']);
Route::delete('categorie/{categorie}', [CategorieController::class, 'destroy']);