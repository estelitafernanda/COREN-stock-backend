<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController, ProductController, SectorController, MovementController, 
    RequestController, NotificationController, SuppliersController
};
use App\Http\Middleware\AuthenticateWithKeycloak;
use App\Http\Middleware\CheckRole;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('users', [UserController::class, 'index']);
    Route::get('show', [ProductController::class, 'index']);
    Route::get('showDepartments', [SectorController::class, 'index']);
    Route::get('showRequests', [RequestController::class, 'index']);
    Route::get('showMovement', [MovementController::class, 'index']);
    Route::get('showUser', [UserController::class, 'index']); 
    Route::get('showSuppliers', [SuppliersController::class, 'index']);
    
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('productFiltered', [ProductController::class, 'showFiltered']);

    Route::get('sectors/{idSector}', [SectorController::class,'show'])->name('sectors.show');
    Route::get('suppliers/{idSupplier}', [SuppliersController::class,'show'])->name('suppliers.show');
    Route::get('products/{idProduct}', [ProductController::class,'show'])->name('products.show');
    Route::get('requests/{idRequest}', [RequestController::class,'show'])->name('requests.show');
    Route::get('users/{idUser}', [UserController::class,'show'])->name('users.show');
    Route::get('movements/{idMovement}' , [MovementController::class, 'show'])->name('movements.show');

   
    Route::patch('notifications/{id}/update', [NotificationController::class, 'update']);


    Route::middleware(['CheckRole:admin'])->group(function () {
        Route::post('addProduct', [ProductController::class, 'store']);
        Route::put('products/{id}', [ProductController::class, 'update']);
        Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::patch('requests/{id}/update', [RequestController::class, 'update']);
        Route::delete('requests/{id}', [RequestController::class, 'destroy'])->name('requests.destroy');

        Route::post('addSector', [SectorController::class, 'store']);
        Route::put('sectors/{id}', [SectorController::class, 'update']);
        Route::delete('sectors/{id}', [SectorController::class, 'destroy'])->name('sectors.destroy');

        Route::post('addSupplier', [SuppliersController::class, 'store']);
        Route::put('suppliers/{id}', [SuppliersController::class, 'update']);
        Route::delete('suppliers/{id}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');

        Route::patch('movements/{id}', [MovementController::class, 'update']);
        Route::delete('movements/{id}', [MovementController::class, 'destroy'])->name('movements.destroy');
    });

    Route::middleware(['CheckRole:user'])->group(function () {
        Route::post('addRequest', [RequestController::class, 'store']);
        Route::patch('requests/{id}', [RequestController::class, 'update']);
    });

});
