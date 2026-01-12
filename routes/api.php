<?php

use App\Http\Controllers\API\AuthorController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('authors')->group(function () {
    Route::get('', [AuthorController::class, 'index']);
    Route::post('', [AuthorController::class, 'store']);
    Route::get('{author}', [AuthorController::class, 'show']);
});

