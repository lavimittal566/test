<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EncryptController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    //return $request->user();

Route::post('/articles', [ArticleController::class, 'store']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::post('/articles/{id}', [ArticleController::class, 'update']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
Route::post('/encrypt', [EncryptController::class, 'encrypt']);
Route::post('/decrypt', [EncryptController::class, 'decrypt']);

});