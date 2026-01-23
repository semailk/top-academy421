<?php

use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('authors')->group(function () {
    Route::get('', [AuthorController::class, 'index']);
    Route::post('', [AuthorController::class, 'store']);
    Route::get('{author}', [AuthorController::class, 'show']);
});
Route::prefix('books')->group(function () {
    Route::get('', [BookController::class, 'index']);
    Route::get('{book}', [BookController::class, 'show']);
    Route::post('', [BookController::class, 'store']);
    Route::delete('{book}', [BookController::class, 'destroy']);
    Route::patch('{book}', [BookController::class, 'update']);
});

