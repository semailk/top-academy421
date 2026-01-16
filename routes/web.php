<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('authors')->group(function () {
    Route::get('', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('trashed', [AuthorController::class, 'trashed'])->name('authors.trashed');
    Route::get('restore', [AuthorController::class, 'getRestoreView'])->name('authors.restore');
    Route::get('{id}', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::delete('{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    Route::patch('restore/{id}', [AuthorController::class, 'restore'])->name('authors.restore.patch');
    Route::patch('{author}', [AuthorController::class, 'update'])->name('authors.update');
});

require __DIR__.'/auth.php';
