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

Route::get('/losowanie1', 'randQuestionController@onequestion');

Route::post('/dodaj_pytanie', 'addQuestionController@addQuestion');