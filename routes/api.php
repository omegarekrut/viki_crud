<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataOutputController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/data', [DataOutputController::class, 'index']);
    Route::post('/data/delete', [DataOutputController::class, 'delete']);
    Route::post('/data/edit', [DataOutputController::class, 'edit']);
    Route::post('/data/store', [DataOutputController::class, 'store']);
});
