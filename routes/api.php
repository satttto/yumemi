<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\Auth\RegisterController@register');
Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/logout', 'Api\Auth\LoginController@logout');

// TODO: ログイン中でないとアクセスできないようにする
Route::get('/rimo-tatsu/task', 'Api\RimoTatsu\TaskController@index');

Route::get('/rimo-tatsu/vote-status', 'Api\RimoTatsu\VoteController@voteStatus');
Route::post('/rimo-tatsu/vote', 'Api\RimoTatsu\VoteController@vote');