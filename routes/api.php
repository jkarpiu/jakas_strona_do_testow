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
    Route::middleware('auth.api')->get('dzialy', 'basicServicesController@dzialy');
    Route::get('typy_szkol', 'basicServicesController@typy_szkol');
    Route::get('wojewodztwa', 'basicServicesController@wojewodztwa');
    Route::get('miasta', 'basicServicesController@miasta');
    Route::get('szkoly', 'basicServicesController@szkoly');
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::post('sendAnswers', 'randQuestionController@json_odpowiadanie_anon');
Route::group(['middleware' => 'auth.api'], function () {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'basicServicesController@user');
    Route::get('wyniki', 'userController@wyniki');
    Route::post('saveAnswers', 'randQuestionController@json_odpowiadanie_zalogowany');
    Route::get('groups', 'groupsController@list_groups');
    Route::post('add_group', 'groupsController@add_group');
    Route::post('invitation', 'groupsController@create_invitation');
    Route::post('join_group',  'groupsController@join_group');
    Route::post('list_students',  'groupsController@list_group_students');
    Route::post('add_post',  'groupsController@add_post');
    Route::post('list_posts',  'groupsController@list_posts');
    Route::post('add_test', 'testsController@createTest');
    Route::post('test_info', 'testsController@getTestInfo');
    Route::get('list_tests', 'testsController@list');
    Route::post('add_comment', 'CommentsController@addcomment');
    Route::post('add_dzial', 'addQuestionController@addDzial');
    Route::post('test_results', 'testsController@getTestsResults');
    Route::post('remove_post', 'groupsController@remove_post');
    Route::post('upcoming_tests', 'testsController@upcomingTests');
    Route::get('authRandQuestion', 'randQuestionController@json_onequestion');
});
