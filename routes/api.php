<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::group(['prefix' => 'dictionary'], function () {
    Route::get('search', 'DictionaryController@search');
    Route::get('entries', 'DictionaryController@getEntries')->middleware('auth:api');
    Route::delete('entries/{id}', 'DictionaryController@deleteEntry')->middleware('auth:api');
    Route::post('entries/{id}', 'DictionaryController@update')->middleware('auth:api');
    Route::post('entries', 'DictionaryController@insert')->middleware('auth:api');
});
Auth::routes();