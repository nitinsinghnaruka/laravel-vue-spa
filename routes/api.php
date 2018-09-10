<?php

use Illuminate\Http\Request;

/**
 *  Auth.
 */
Route::post('/register', 'API\Auth\RegisterController@create');
Route::post('/login', 'API\Auth\LoginController@authenticate');
Route::post('/logout', 'API\Auth\LoginController@logout');

Route::get('/messages', 'API\MessageController@index');
Route::post('/messages', 'API\MessageController@store');
