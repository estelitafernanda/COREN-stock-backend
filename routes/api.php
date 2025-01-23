<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SuppliersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index']);

Route::get('show', [ProductController::class, 'index']);
Route::get('showDepartments', [SectorController::class, 'index']);
Route::get('showRequests', [RequestController::class, 'index']);
Route::get('showMovement', [MovementController::class, 'index']);
Route::get('showUser', [UserController::class, 'index']); 
Route::get('showSuppliers', [SuppliersController::class, 'index']);

Route::get('sectors/{idSector}', [SectorController::class,'show'])->name('sectors.show');
Route::get('suppliers/{idSupplier}', [SuppliersController::class,'show'])->name('suppliers.show');
Route::get('products/{idProduct}', [ProductController::class,'show'])->name('products.show');
Route::get('movements/{idMovement}', [MovementController::class,'show'])->name('movements.show');

Route::post('addRequest', [RequestController::class, 'store']);
Route::post('addProduct', [ProductController::class, 'store']);
Route::post('addSector', [SectorController::class, 'store']);
Route::post('addMovement', [MovementController::class, 'store']);
Route::post('addSupplier', [SuppliersController::class, 'store']);