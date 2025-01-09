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

Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Formulário de criação
Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Ação de armazenamento
Route::get('/users/{id}', [UserController::class,'show'])->name('users.show');
/*Route::get('/product/create', [ProductController::class, 'create']->name('product.create'));
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::get('/movement/create', [MovementController::class, 'create']->name('movement.create'));
Route::post('/movement', [MovementController::class, 'store'])->name('movement.store');

Route::get('/supplier/create', [SuppliersController::class, 'create']->name('supplier.create'));
Route::post('/supplier', [SuppliersController::class, 'store'])->name('supplier.store');

Route::get('/request/create', [RequestController::class, 'create']->name('product.create'));
Route::post('/request', [RequestController::class, 'store'])->numfmt_get_pattern('request.store');
*/