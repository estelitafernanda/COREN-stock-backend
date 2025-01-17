<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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


Route::post('addRequest', [RequestController::class, 'store']);
Route::post('addProduct', [ProductController::class, 'store']);