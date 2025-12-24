<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('authors')->group(function () {
    Route::get('', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('{author}', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::patch('{author}', [AuthorController::class, 'update'])->name('authors.update');
});

