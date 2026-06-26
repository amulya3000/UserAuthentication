<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () { 
    return view('welcome');
});
Route::view('register','register')->name ('register');
Route::post('registerSave',[UserController::class,'registration'])->name('registerSave');
Route::view('login', 'login')->name('login');
Route::post('login', [UserController::class, 'Login'])->name('loginMatch'); 
Route::get('dashboard',[UserController::class,'dashboardPage'])->name('dashboard');
Route::post('logout',[UserController::class,'logout'])->name('logout');



