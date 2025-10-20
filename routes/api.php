<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class , "index"])->name('users.index');


Route::middleware('auth:sanctum')->post('/users', [UserController::class , "store"])->name('users.store');
