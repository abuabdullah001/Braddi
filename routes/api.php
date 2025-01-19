<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});


Route::get('/blog/index',[BlogController::class,'index']);
Route::post('/blog/store',[BlogController::class,'store']);
Route::get('/blog/create',[BlogController::class,'create']);
Route::get('/blog/edit/{id}',[BlogController::class,'edit']);
Route::put('/blog/update/{id}',[BlogController::class,'update']);
Route::delete('/blog/delete/{id}',[BlogController::class,'delete']);
Route::get('/blog/show/{id}',[BlogController::class,'show']);


