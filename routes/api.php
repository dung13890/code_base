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

Route::group(['prefix' => 'v1', 'as' => 'api.v0.', 'namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {

    });

    Route::group(['middleware' => ['auth:api']], function () {

    });
});

