<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AuthenticateWithKeycloak;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\NotificationController;
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
Route::get('requests/{idRequest}', [RequestController::class,'show'])->name('requests.show');
Route::get('users/{idUser}', [UserController::class,'show'])->name('users.show');
Route::get('movements/{idMovement}' , [MovementController::class, 'show'])->name('movements.show');

Route::post('addRequest', [RequestController::class, 'store']);
Route::post('addProduct', [ProductController::class, 'store']);
Route::get('productFiltered', [ProductController::class, 'showFiltered']);
Route::post('addSector', [SectorController::class, 'store']);
Route::post('addMovement', [MovementController::class, 'store']);
Route::post('addSupplier', [SuppliersController::class, 'store']);

Route::patch('movements/{id}/update', [MovementController::class, 'update']);
Route::put('products/{id}/update', [ProductController::class, 'update']);
Route::patch('requests/{id}/update', [RequestController::class, 'update']);
Route::put('sectors/{id}/update', [SectorController::class, 'update']); 
Route::put('movements/{id}/update',[MovementController::class, 'update']); 
Route::put('suppliers/{id}/update', [SuppliersController::class, 'update']); 

Route::delete('requests/{id}', [RequestController::class, 'destroy'])->name('requests.destroy');
Route::delete('sectors/{id}', [SectorController::class, 'destroy'])->name('sectors.destroy');
Route::delete('movements/{id}', [MovementController::class, 'destroy'])->name('movements.destroy');
Route::delete('suppliers/{id}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('notifications', [NotificationController::class, 'index']);
Route::patch('notifications/{id}/update', [NotificationController::class, 'update']);