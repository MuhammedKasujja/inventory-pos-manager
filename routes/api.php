<?php

use App\Http\Controllers\DataUploadController;
use App\Jobs\SendMessageJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/messages', [DataUploadController::class, 'index']);

Route::post('/messages', [DataUploadController::class, 'store']);

Route::get('/remote-uploads', [DataUploadController::class, 'index']);

Route::post('/upload-updates', [DataUploadController::class, 'store']);

Route::get('/messages/test', [DataUploadController::class, 'testMessage']);

Route::get('/channel/test', function(){
    SendMessageJob::dispatch();
    return "Message send";
});
