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
Route::get('/create', 'SubmissionController@create')->name('submissionCreate');
Route::post('/create', 'SubmissionController@store')->name('submissionStore');
