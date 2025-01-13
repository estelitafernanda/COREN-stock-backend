<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SuppliersController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); 
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{idUser}', [UserController::class,'show'])->name('users.show');
Route::get('/users/{idUser}/edit', [UserController::class, 'edit'])->name('users.edit'); 
Route::put('/users/{idUser}/update', [UserController::class, 'update'])->name('users.update');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); 
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{idProduct}', [ProductController::class,'show'])->name('products.show');
Route::get('/products/{idProduct}/edit', [ProductController::class, 'edit'])->name('products.edit'); 
Route::put('/products/{idProduct}/update', [ProductController::class, 'update'])->name('products.update');

Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');
Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
Route::get('/requests/{idRequest}', [RequestController::class,'show'])->name('requests.show');
Route::get('/requests{idRequest}/edit', [RequestController::class, 'edit'])->name('requests.edit'); 
Route::put('/requests/{idRequest}/update', [RequestController::class, 'update'])->name('requests.update');


/*Route::get('/product/create', [ProductController::class, 'create']->name('product.create'));
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::get('/movement/create', [MovementController::class, 'create']->name('movement.create'));
Route::post('/movement', [MovementController::class, 'store'])->name('movement.store');

Route::get('/supplier/create', [SuppliersController::class, 'create']->name('supplier.create'));
Route::post('/supplier', [SuppliersController::class, 'store'])->name('supplier.store');
*/

