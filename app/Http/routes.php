<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('/', [
	'as'   => 'root_path',
	'uses' => 'PinsController@index'
]);

resource('pins', 'PinsController');

get('users/{id}/favorites', [
	'as'    => 'favorites_path',
	'uses' => 'PinsController@favorites'
]);

put('favorites/{id}', [
	'as'    => 'favorite_path',
	'uses' => 'PinsController@favorite'
]);

delete('favorites/{id}', [
	'as'    => 'favorite_path',
	'uses' => 'PinsController@unfavorite'
]);

// Authentication routes...
get('auth/login', 'Auth\AuthController@getLogin');
post('auth/login', 'Auth\AuthController@postLogin');
get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
get('auth/register', 'Auth\AuthController@getRegister');
post('auth/register', 'Auth\AuthController@postRegister');

// Account edit routes...
get('auth/user/edit', [
	'middleware' => 'auth',
	'as'    => 'user_edit_path',
	'uses'	=> 'Auth\AuthController@getEdit'
]);

patch('auth/user/edit', [
	'middleware' => 'auth',
	'as'    => 'user_path',
	'uses'	=> 'Auth\AuthController@patchEdit'
]);

// Password reset link request routes...
get('password/email', 'Auth\PasswordController@getEmail');
post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
get('password/reset/{token}', 'Auth\PasswordController@getReset');
post('password/reset', 'Auth\PasswordController@postReset');