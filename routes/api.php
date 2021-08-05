<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskSetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('signin', [AuthController::class, 'signIn']);
Route::middleware('auth:api')->group(function () {
    Route::get('task-set', [TaskSetController::class, 'getTaskSet']);
    Route::put('task-set/skip/{id}', [TaskSetController::class, 'skipTask']);
    Route::put('task-set/complete/{id}', [TaskSetController::class, 'markAsCompleted']);
});
