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

Route::pattern('user', '[0-9]+');
Route::pattern('shout', '[0-9]+');

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
Route::group(array('before' => 'hasRole:SuperAdmin'), function()
{
	Route::get(
		'user/{user}/roles',
		array('as' => 'user.roles.edit',
			'uses' => 'Zeropingheroes\LanagerCore\UserController@editRoles')
	);
	Route::put(
		'user/{user}/roles',
		array('as' => 'user.roles.update',
			'uses' => 'Zeropingheroes\LanagerCore\UserController@updateRoles')
	);
});
Route::resource('user', 'Zeropingheroes\LanagerCore\UserController');

// Info Page
Route::resource('infoPage', 'Zeropingheroes\LanagerCore\InfoPageController');

// Shout
Route::resource('shout', 'Zeropingheroes\LanagerCore\ShoutController');
Route::get(
	'shout/pin/{shout}',
	array('as' => 'shout.pin',
		'uses' => 'Zeropingheroes\LanagerCore\ShoutController@pin')
);

// Statistics
Route::get(
	'statistics/applications/current-usage',
	array('as' => 'statistics.applications.current-usage',
		'uses' => 'Zeropingheroes\LanagerCore\StateController@currentApplicationUsage')
);
Route::get(
	'statistics/servers/current-usage',
	array('as' => 'statistics.servers.current-usage',
		'uses' => 'Zeropingheroes\LanagerCore\StateController@currentServerUsage')
);

// Events
Route::get('event/timetable', 
	array('as' => 'event.timetable',
		'uses' => 'Zeropingheroes\LanagerCore\EventController@timetable')
);
Route::resource('event', 'Zeropingheroes\LanagerCore\EventController');


// Default
Route::get('/', array('before' => 'installed', function()
{
	return Redirect::to('shout');
}));