<?php

use App\Http\Controllers\DataUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/messages', [DataUploadController::class, 'index']);

Route::post('/messages', [DataUploadController::class, 'store']);

Route::get('/messages/test', [DataUploadController::class, 'testMessage']);
