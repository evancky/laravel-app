<?php

use App\Http\Controllers\API\TodoApiController;
// use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('todos', TodoListController::class);


// Route::get('/todos', [TodoApiController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    Route::get('todos', [TodoApiController::class, 'index']);
    Route::post('todos', [TodoApiController::class, 'store']);
    Route::put('todos/{todo}', [TodoApiController::class, 'update']);
    Route::delete('todos/{todo}', [TodoApiController::class, 'destroy']);
});


