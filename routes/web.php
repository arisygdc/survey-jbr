<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SurveyerController;
use App\Http\Controllers\WelcomeController;
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
Route::get('/', [WelcomeController::class, 'index']);
Auth::routes();
Route::prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin-home');
    Route::get('/survey', [AdminController::class, 'survey_index'])->name('get.survey');
    Route::get('/users', [AdminController::class, 'users_index'])->name('get.users');
    Route::get('/users/register', [AdminController::class, 'store_index'])->name('get.register');
    Route::post('/users/register', [AdminController::class, 'store'])->name('store.users');
});

Route::prefix('surveyer')->group(function() {
    Route::get('/', [SurveyerController::class, 'index'])->name('surveyer-home');
    Route::get('/survey', [SurveyerController::class, 'survey_index'])->name('survey');

    Route::post('/survey', [SurveyerController::class, 'survey'])->name('store.survey');
});
