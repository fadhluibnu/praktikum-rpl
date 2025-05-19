<?php

use App\Http\Controllers\LlamaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/llama', [LlamaController::class, 'ask']);
