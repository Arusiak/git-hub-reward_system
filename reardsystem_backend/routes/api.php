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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/user-profile', 'AuthController@userProfile');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {
    Route::post('{id}/send', 'PointController@sendGift');
    Route::get('{id}/available', 'PointController@availableUsers');
    Route::get('{id}/notifications', 'PointController@notifications');
    Route::get('{id}/admin/notifications', 'PointController@adminNotifications');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'

], function ($router) {
    Route::get('{id}/notifications', 'PointController@adminNotifications');
    Route::get('{id}/users', 'PointController@getUsers');
});
