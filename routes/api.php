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

Route::get('randQuestion', 'randQuestionController@json_onequestion');

Route::group(['prefix' => 'basic'], function () {
    Route::get('dzialy', 'basicServicesController@dzialy');
    Route::get('typy_szkol', 'basicServicesController@typy_szkol');
    Route::get('wojewodztwa', 'basicServicesController@wojewodztwa');
    Route::get('miasta', 'basicServicesController@miasta');
    Route::get('szkoly', 'basicServicesController@szkoly');
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::post('sendAnswers', 'randQuestionController@json_odpowiadanie');
Route::group(['middleware' => 'auth.api'], function () {
    Route::get('user', 'basicServicesController@user');
    Route::get('logout', 'AuthController@logout');
});
