<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');

// Route sécurisé
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');


    Route::prefix('employers')->group(function(){
        Route::get('/', [EmployerController::class, 'index'])->name('employers.index');
    });
    Route::prefix('employers')->group(function(){
        Route::get('/create', [EmployerController::class, 'create'])->name('employers.create');
    });
    Route::prefix('employers')->group(function(){
        Route::get('/edit/{employer}', [EmployerController::class, 'edit'])->name('employers.edit');
    });

});
