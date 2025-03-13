<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StatistiqueController;

Route::get('rayon/{id}/produits', [RayonController::class, 'Produits']);
Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [UserAuthController::class, 'logout']);
Route::post('admin/login', [UserAuthController::class, 'adminLogin']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('categories', CategorieController::class);
Route::apiResource('rayons', RayonController::class);
Route::apiResource('produits', ProduitController::class);
Route::get('statistiques', [StatistiqueController::class, 'index']);
Route::get('list',[ProduitController::class,'list']);