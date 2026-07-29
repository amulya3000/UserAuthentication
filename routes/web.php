<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BacklogController;
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

Route::middleware(['ok-user'])->group(function() {
    Route::get('dashboard', [UserController::class, 'dashboardPage'])->name('dashboard');
    Route::get('admin', [UserController::class, 'index'])->name('admin'); 

    Route::post('task', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('task/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status');

    Route::post('/admin/project', [ProjectController::class, 'update'])->name('admin.project.update');
});

Route::post('admin/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
Route::post('admin/users/{user}/reject', [UserController::class, 'reject'])->name('admin.users.reject');

Route::post('logout', [UserController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return redirect()->route('backlog');
});


Route::get('/backlog', [BacklogController::class, 'index'])->name('backlog');
Route::post('/backlog', [BacklogController::class, 'store'])->name('backlog.store');
Route::put('/backlog/{id}', [BacklogController::class, 'update'])->name('backlog.update');
Route::delete('/backlog/{id}', [BacklogController::class, 'destroy'])->name('backlog.destroy');


Route::get('/sprint', [BacklogController::class, 'sprintIndex'])->name('sprint');
Route::post('/sprint', [BacklogController::class, 'storeSprintItem'])->name('sprint.store');
Route::post('/scrum/{id}/status', [BacklogController::class, 'updateStatus'])->name('scrum.status');

Route::get('/scrum', [BacklogController::class, 'scrumIndex'])->name('scrum');