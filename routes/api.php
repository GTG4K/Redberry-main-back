<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::controller(LanguageController::class)->prefix('language')->group(function () {
    Route::get('/', 'getLanguage');
    Route::post('/', 'setLanguage');
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

// protected api
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::controller(QuoteController::class)->prefix('quotes')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::post('/{id}', 'delete');
        Route::post('/update/{id}', 'update');
    });
    Route::controller(CommentController::class)->prefix('comments')->group(function () {
        Route::post('/', 'store');
    });
    Route::controller(MovieController::class)->prefix('movies')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::post('/{id}', 'delete');
        Route::post('/update/{id}', 'update');
    });
    Route::controller(LikeController::class)->prefix('likes')->group(function () {
        Route::post('/{quote}', 'toggleLike');
    });
    Route::controller(NotificationController::class)->prefix('notifications')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'allSeen');
        Route::post('/{id}', 'seen');
    });
});
