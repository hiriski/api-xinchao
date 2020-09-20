<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PhrasebookController;
use App\Http\Controllers\PhrasebookCategoryController;

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


/**
 * Authentication routes
 */
Route::prefix('/auth')->group(function() {
    Route::post(
        '/register',
        RegisterController::class
    )->name('register');
    Route::post(
        '/login',
        LoginController::class
    )->name('login');
    Route::post(
        '/logout',
        LogoutController::class
    )->name('logout');
});

/**
 * User
 */
Route::get(
    '/user',
    UserController::class
)->name('user');

/**
 * PhraseBook
 */
Route::apiResource(
    '/phrasebook',
    PhrasebookController::class
)->except(['show']);

Route::name('phrasebook.')->group(function() {
    Route::apiResource(
        '/phrasebook/category',
        PhrasebookCategoryController::class
    );
});
