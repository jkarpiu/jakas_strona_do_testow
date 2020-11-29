<?php

use Illuminate\Support\Facades\Route;
use App\Pytania;
use App\Dzialy;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add', function () {
    return view('form', [
        'dzialy' => Dzialy::get()
    ]);
});

Route::get('/losowanie1', 'randQuestionController@onequestion')->name('losowanie1'); 

Route::get('/losowanie40', function(){
    return view("random40");
})->name('losowanie40');

Route::get('/wyniki', function() {
    return view('wyniki');
});



Route::post('/dodaj_pytanie', 'addQuestionController@addQuestion');

Route::post('/odp', 'randQuestionController@odpowiadanie');

Route::get('/google_login', 'Auth\LoginController@redirectToProvider');

Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('teacher', function () {
    return view('teacherPanel');
}) -> name('teacherPanel');

Route::group(['prefix' => 'auth_api', 'middleware' => 'auth'], function () {
    Route::get('classrooms', 'groupsController@list_groups');
});