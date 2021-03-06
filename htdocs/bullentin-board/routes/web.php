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

Route::group(['as' => 'sureddo.'], function() {
    Route::get('/', 'SureddoController@index')->name('index');
    Route::post('/', 'SureddoController@create')->name('create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');