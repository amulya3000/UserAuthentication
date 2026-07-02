<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TestUser;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { 
    return view('landing');
})->name('landing');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::view('register', 'register')->name('register');


Route::post('registerSave', [UserController::class, 'registration'])->name('registerSave');


Route::view('login', 'login')->name('login');
Route::post('login', [UserController::class, 'Login'])->name('loginMatch'); 

// Route::get('dashboard', [UserController::class, 'dashboardPage'])
//     ->name('dashboard')
//     ->middleware('IsUserValid',TestUser::class);

Route::middleware(['ok-user'])->group(function(){
    Route::get('dashboard', [UserController::class, 'dashboardPage'])->name('dashboard');
}); 



Route::post('logout', [UserController::class, 'logout'])->name('logout');
 