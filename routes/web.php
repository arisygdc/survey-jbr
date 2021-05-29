<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin-home');
    Route::get('/users', [AdminController::class, 'users_index']);
    // Route::post('/users', [AdminController::class, 'register']);
});

Route::prefix('surveyer')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('surveyer-home');
    Route::post('/survey', [UserController::class, 'survey'])->name('survey');
    Route::get('/survey/get', [UserController::class, 'get_survey']);
});
