<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BacklogController;
use App\Http\Controllers\AdminNoteController;
use Illuminate\Support\Facades\Route;

// ─── Public routes ────────────────────────────────────────────────────────────
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

// ─── Admin Notes (public JSON endpoint for employees) ─────────────────────────
Route::get('/admin-notes', [AdminNoteController::class, 'show'])->name('admin.notes.show');

// ─── Authenticated routes ──────────────────────────────────────────────────────
Route::middleware(['ok-user'])->group(function () {

    // Dashboard
    Route::get('dashboard', [UserController::class, 'dashboardPage'])->name('dashboard');

    // Admin panel
    Route::get('admin', [UserController::class, 'index'])->name('admin');

    // Task management
    Route::post('task', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('task/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status');

    // Project management
    Route::post('/admin/project', [ProjectController::class, 'update'])->name('admin.project.update');

    // User approval / rejection
    Route::post('admin/users/{user}/approve',    [UserController::class, 'approve'])->name('admin.users.approve');
    Route::post('admin/users/{user}/reject',     [UserController::class, 'reject'])->name('admin.users.reject');

    // User Role Control
    Route::post('admin/users/{user}/role',       [UserController::class, 'changeRole'])->name('admin.users.role');
    Route::post('admin/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::post('admin/users/{user}/reactivate', [UserController::class, 'reactivate'])->name('admin.users.reactivate');

    // Admin Notes (DB-backed broadcast)
    Route::post('/admin/notes',                  [AdminNoteController::class, 'store'])->name('admin.notes.store');
    Route::delete('/admin/notes',                [AdminNoteController::class, 'destroy'])->name('admin.notes.destroy');

    // Logout
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});

// ─── Backlog / Sprint / Scrum ─────────────────────────────────────────────────
Route::get('/backlog', [BacklogController::class, 'index'])->name('backlog');
Route::post('/backlog', [BacklogController::class, 'store'])->name('backlog.store');
Route::put('/backlog/{id}', [BacklogController::class, 'update'])->name('backlog.update');
Route::delete('/backlog/{id}', [BacklogController::class, 'destroy'])->name('backlog.destroy');

Route::get('/sprint', [BacklogController::class, 'sprintIndex'])->name('sprint');
Route::post('/sprints', [BacklogController::class, 'storeSprint'])->name('sprints.store');
Route::put('/sprints/{id}', [BacklogController::class, 'updateSprint'])->name('sprints.update');
Route::post('/sprints/{sprint_id}/issues', [BacklogController::class, 'storeSprintItem'])->name('sprint.issue.store');
Route::post('/scrum/{id}/status', [BacklogController::class, 'updateStatus'])->name('scrum.status');

Route::get('/scrum', [BacklogController::class, 'scrumIndex'])->name('scrum');