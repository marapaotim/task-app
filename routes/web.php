<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/tasks', function () {
    return view('tasks');
});

Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout']);
Route::post('/signup_user', [\App\Http\Controllers\UserController::class, 'signupUser']);
Route::post('/login_user', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('/get_tasks/{limit}/{status}/{sortTitle}/{sortDate}/{saveStatus}/{search?}',
    [\App\Http\Controllers\TaskController::class, 'getTasksPaginate'])->middleware('auth');
Route::post('/create_task', [\App\Http\Controllers\TaskController::class, 'create'])->middleware('auth');
Route::post('/update_task/{id}', [\App\Http\Controllers\TaskController::class, 'update'])->middleware('auth');
Route::get('/remove_task/{id}', [\App\Http\Controllers\TaskController::class, 'remove'])->middleware('auth');
