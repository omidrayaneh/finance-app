<?php

use App\Http\Controllers\Api\Admin\AccountController;
use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users',[UserController::class,'index']);
Route::get('/user/{id}',[UserController::class,'show']);
Route::post('/user/create',[UserController::class,'store']);
Route::patch('/user/update/{id}',[UserController::class,'update']);
Route::post('/user/delete/{id}',[UserController::class,'destroy'])->name('user.delete');


Route::get('/accounts',[AccountController::class,'index']);
Route::get('/account/{account_no}',[AccountController::class,'show']);
Route::post('/account/create',[AccountController::class,'store']);
Route::patch('/account/update/{account_no}',[AccountController::class,'update']);
Route::patch('/account/disabled/{account_no}',[AccountController::class,'disabled']);
Route::patch('/account/enabled/{account_no}',[AccountController::class,'enabled']);
