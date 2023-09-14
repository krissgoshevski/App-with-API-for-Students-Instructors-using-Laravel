<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::middleware('auth:api')->get('/users', [UserController::class, 'getUsers']);

Route::middleware('auth:api')->get('/student/{id}', [UserController::class, 'getStudent']);
Route::middleware('auth:api')->post('/update/{id}', [UserController::class, 'updateStudent']);

Route::middleware('auth:api')->post('/delete/{id}', [UserController::class, 'deleteStudent']);

Route::middleware('auth:api')->post('/student/create', [UserController::class, 'storeStudent']);




Route::middleware('auth:api')->post('/search', [UserController::class, 'search']);





