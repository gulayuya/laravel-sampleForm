<?php

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

Route::get('/', 'FrontController@index')->name('index');

Route::post('/confirm', 'FrontController@confirm');

Route::post('/regist', 'FrontController@regist');

Route::get('/answers/index', 'AnswerController@index')->name('answers.index');

Route::get('/search', 'AnswerController@search');

Route::get('/answers/{answer}', 'AnswerController@show');

Route::post('/delete', 'AnswerController@delete');