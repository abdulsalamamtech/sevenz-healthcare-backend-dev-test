<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicalRecordController;


// Authentication file
require __DIR__.'/api-auth.php';


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});




// Sevenz healthcare backend developer test
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/medical-records', [MedicalRecordController::class, 'get']);
    Route::post('/medical-records', [MedicalRecordController::class, 'store']);
});




Route::get('/users', function (){
    return User::all();
});

Route::get('/records', function (){
    return MedicalRecord::all();
});

Route::get('api', function(){
    return 'api running...';
});
