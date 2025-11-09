<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Controllers\Api\v1\AuthContrller;



Route::post('/login', [AuthContrller::class, 'login'])->name('login');
Route::post('/register', [AuthContrller::class, 'register'])->name('register');
Route::middleware('auth::sanctum')->post('/logout', [AuthContrller::class, 'logout'])->name('logout');



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');






