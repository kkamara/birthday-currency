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

Route::get('/', 'SubmissionController@index')->name('home');
Route::get('/giveitago', 'SubmissionController@create')->name('submissionCreate');
Route::post('/giveitago', 'SubmissionController@store')->name('submissionStore');
