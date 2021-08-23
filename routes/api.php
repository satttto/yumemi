<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RimoTatsu\TaskController;

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

Route::post('/register', 'Api\Auth\RegisterController@register');
Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/logout', 'Api\Auth\LoginController@logout');

Route::middleware('auth:api')->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    
    Route::prefix('rimo-tatsu')->group(function () {
        Route::get('task', [TaskController::class, 'index']);
    
        Route::get('achievement', 'Api\RimoTatsu\AchievementController@index');
        Route::post('achievement', 'Api\RimoTatsu\AchievementController@update');
    
        Route::get('vote-status', 'Api\RimoTatsu\VoteController@voteStatus');
        Route::post('vote', 'Api\RimoTatsu\VoteController@vote');
        Route::get('winner', 'Api\RimoTatsu\VoteController@getWinner');
    });
});

