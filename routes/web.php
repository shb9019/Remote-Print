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

Route::get('/','LoginController@redirect');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', 'LoginController@redirect');

Route::post('login', array('as' => 'login', 'uses' => 'LoginController@loginValidate' ));