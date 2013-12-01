<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// User
Route::get(
	'user/openidlogin',
	array('as' => 'user.openIdLogin',
		'uses' => 'Zeropingheroes\LanagerCore\UserController@openIdLogin')
);
Route::get(
	'user/logout',
	array('as' => 'user.logout',
		'uses' => 'Zeropingheroes\LanagerCore\UserController@logout')
);
Route::resource('user', 'Zeropingheroes\LanagerCore\UserController');



// Info
Route::resource('info', 'Zeropingheroes\LanagerCore\InfoPageController');



// Default
Route::get('/', function()
{
	return Redirect::to('info');
});