<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Api\Auth\AuthController;


Route::post('register', [AuthController::class, 'register'])
    ->middleware('guest');

Route::post('login', [AuthController::class, 'login'])
    ->middleware('guest');

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function(){
    // Notes route
    Route::apiResource('notes', NoteController::class);
});
