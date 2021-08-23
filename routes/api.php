<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

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

Route::post('/register', [Api\Auth\RegisterController::class, 'register']);
Route::post('/login', [Api\Auth\LoginController::class, 'login']);
Route::post('/logout', [Api\Auth\LoginController::class, 'logout']);

Route::middleware('auth:api')->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    
    Route::prefix('rimo-tatsu')->group(function () {
        Route::get('task', [Api\RimoTatsu\TaskController::class, 'index']);
    
        Route::get('achievement', [Api\RimoTatsu\AchievementController::class, 'index']);
        Route::post('achievement', [Api\RimoTatsu\AchievementController::class, 'update']);
    
        Route::get('vote-status', [Api\RimoTatsu\VoteController::class, 'voteStatus']);
        Route::post('vote', [Api\RimoTatsu\VoteController::class, 'vote']);
        Route::get('winner', [Api\RimoTatsu\VoteController::class, 'getWinner']);
    });
});

