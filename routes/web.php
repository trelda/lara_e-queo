<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::group(['namespace' => '\App\Http\Controllers\User', 'middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users/{id}', [App\Http\Controllers\User\EditController::class, '__invoke'])->name('user.edit');
    Route::patch('/user/{user}', [App\Http\Controllers\User\UpdateController::class, '__invoke'])->name('user.update');
});

Route::group(['namespace' => '\App\Http\Controllers\File', 'middleware' => 'auth'], function() {
    Route::get('/files', [App\Http\Controllers\File\IndexController::class, '__invoke'])->name('file.index');
    Route::get('/files/upload', [App\Http\Controllers\File\UploadController::class, '__invoke'])->name('file.upload');
    Route::post('/files/upload', [App\Http\Controllers\File\StoreController::class, '__invoke'])->name('file.update');
});