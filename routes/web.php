<?php

use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('check_role');
Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name('instructor.home');
Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::get('/student/create', [App\Http\Controllers\UserController::class, 'create'])->name('student.create');


