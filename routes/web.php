<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return view('welcome');

});

// File
Route::get('/file/index',[FileController::class,'index'])->name('file.index');
Route::post('/file/store',[FileController::class,'store'])->name('file.store');
Route::get('/file/create',[FileController::class,'create'])->name('file.create');
Route::get('file/show/{id}',[FileController::class,'show'])->name('file.show');
Route::delete('file/delete/{id}',[FileController::class,'delete'])->name('file.delete');
Route::get('file/edit/{id}',[FileController::class,'edit'])->name('file.edit');
Route::put('file/update/{id}',[FileController::class,'update'])->name('file.update');



// Blog
Route::get('/blog/index',[BlogController::class,'index'])->name('blog.index');
Route::post('/blog/store',[BlogController::class,'store'])->name('blog.store');
Route::get('/blog/create',[BlogController::class,'create'])->name('blog.create');
Route::get('/blog/edit/{id}',[BlogController::class,'edit'])->name('blog.edit');
Route::put('/blog/update/{id}',[BlogController::class,'update'])->name('blog.update');
Route::delete('/blog/delete/{id}',[BlogController::class,'delete'])->name('blog.delete');
Route::get('/blog/show/{id}',[BlogController::class,'show'])->name('blog.show');


