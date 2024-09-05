<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-list', [TaskController::class, 'index']);
Route::get('/get-all-list', [TaskController::class, 'showAllTask']);

Route::post('/store', [TaskController::class, 'store']);
Route::post('/tasks/complete/{id}', [TaskController::class, 'stausUpdate']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

