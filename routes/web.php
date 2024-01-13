<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::resource('users', UserController::class)->except(['show', 'edit', 'update']);
    // Route::get('users', [UserController::class, 'index'])->name('users.index');
    // Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('users', [UserController::class, 'store'])->name('users.store');
    // Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('projects', ProjectController::class);
    // Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    // Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    // Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    // Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    // Route::patch('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    // Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::prefix('projects')->group(function(){
        Route::get('{project}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });
});

require __DIR__.'/auth.php';

