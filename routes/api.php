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
Route::prefix('rimo-tatsu')->group(function () {

    Route::get('task', 'Api\RimoTatsu\TaskController@index');

    Route::get('achievement', 'Api\RimoTatsu\AchievementController@index');
    Route::post('achievement', 'Api\RimoTatsu\AchievementController@update');
});
