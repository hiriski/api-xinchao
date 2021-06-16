<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PhrasebookController;
use App\Http\Controllers\PhrasebookCategoryController;
use App\Http\Controllers\Discussion\DiscussionController;
use App\Http\Controllers\Discussion\TopicController;
use App\Http\Controllers\Discussion\ReplyController;
use App\Http\Controllers\Discussion\FavoriteDiscussionController;
use App\Http\Controllers\Discussion\FavoriteReplyController;
use App\Http\Controllers\FavoritePhrasebookController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;

/*
|---------------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json([
        'app_name'          => 'Xin Chao 👋',
        'message'           => 'Application is Running...',
        'time'              => \Carbon\Carbon::now(),
        'author'            => 'Riski',
        'author_email'      => 'hiriski@outlook.com',
        'author_website'    => 'https://riski.me',
        'repositories'      => [
            'client'            => 'https://github.com/hiriski/react-native-hoctiengviet',
            'server'            => 'https://github.com/hiriski/laravel-hoc-tieng-viet-api',
        ]
    ]);
});

/*
|--------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------
*/
Route::prefix('/auth')->group(function () {
    Route::post('/social', App\Http\Controllers\Auth\SocialAccountController::class)->name('social');
    Route::post('/register', App\Http\Controllers\Auth\RegisterController::class)->name('register');
    Route::post('/login', App\Http\Controllers\Auth\LoginController::class)->name('login');
    Route::post('/revoke-token', [App\Http\Controllers\Auth\AuthController::class, 'revokeToken'])->name('revoke-token');
    Route::get('/get-authenticated-user', [App\Http\Controllers\Auth\AuthController::class, 'getAuthenticatedUser'])->name('get-authenticated-user');
});

/*
|--------------------------------------------------------
| A User Routes
|--------------------------------------------------------
*/
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/user', [UserController::class, 'index']);

/*
|--------------------------------------------------------
| Phrasebook Routes
|--------------------------------------------------------
*/
Route::name('phrasebook.')->group(function () {
    Route::prefix('/phrasebook')->group(function () {
        Route::apiResource('/category', PhrasebookCategoryController::class);
        /** Favorite phrasebook */
        Route::post('/favorite/{phrasebook}', [FavoritePhrasebookController::class, 'store'])
            ->name('favorite.store');
        Route::delete('/favorite/{phrasebook}', [FavoritePhrasebookController::class, 'destroy'])
            ->name('favorite.destroy');
    });
});
Route::apiResource('/phrasebook', PhrasebookController::class)
    ->except(['show']);

/*
|--------------------------------------------------------
| Discussion/Thread Routes
|--------------------------------------------------------
*/
Route::name('discussion.')->group(function () {
    Route::prefix('/discussion')->group(function () {
        Route::apiResource('/topic', TopicController::class);
        Route::apiResource('{discussion}/reply', ReplyController::class)
            ->except(['index', 'show']);
        /** Favorite discussion */
        Route::post('/favorite/{discussion}', [FavoriteDiscussionController::class, 'store'])
            ->name('favorite.store');
        Route::delete('/favorite/{discussion}', [FavoriteDiscussionController::class, 'destroy'])
            ->name('favorite.destroy');
        /** Favorite reply */
        Route::post('/reply/favorite/{reply}', [FavoriteReplyController::class, 'store'])
            ->name('reply.favorite.store');
        Route::delete('/reply/favorite/{reply}', [FavoriteReplyController::class, 'destroy'])
            ->name('reply.favorite.destroy');
    });
});
Route::apiResource('/discussion', DiscussionController::class);

/*
|--------------------------------------------------------
| Conversations Message.
|--------------------------------------------------------
*/
Route::post('/conversation/send-first-message/{toUserId}', [MessageController::class, 'firstMessage']);
Route::get('/conversation', [ConversationController::class, 'index']);
Route::post('/message/{conversationId}', [MessageController::class, 'send']);
Route::get('/message/{conversationId}', [MessageController::class, 'fetch']);
