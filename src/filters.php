<?php

/*
|--------------------------------------------------------------------------
| First Time Install
|--------------------------------------------------------------------------
|
| Checks if the app has been marked as installed.
|
*/

Route::filter('installed', function()
{
	if (Config::get('lanager-core::installationCompleted') !== true ) return Redirect::to('install');
});


/*
|--------------------------------------------------------------------------
| Resource Permission
|--------------------------------------------------------------------------
|
| Checks if the logged in user can perform the requested action on the
| requested resource item.
| Gets resource type (e.g. User) action (e.g. delete) and item id from request.
|
*/
Route::filter('checkResourcePermission', function($route, $request)
{
	// Get request details
	$routeName = explode('.', Route::currentRouteName());
	$resource = $routeName[0];
	$action = $routeName[1];
	$item = $route->parameter($resource);

	// Replace laravel-style route action names with their CRUD equivalents
	$actionsToReplace = array('store', 'show', 'index', 'edit', 'destroy');
	$replaceWithAction = array('create', 'read', 'read', 'update', 'delete');
	$action = str_replace($actionsToReplace, $replaceWithAction, $action);

	// Check if user is forbidden from performing $action on $resource $item
	if( Authority::cannot($action, $resource, $item) )
	{
		return App::abort(403, 'You do not have permission to '.$action.' '.$resource.' '.$item);
	}
});


/*
|--------------------------------------------------------------------------
| Role
|--------------------------------------------------------------------------
|
| Checks if the logged in user has been assigned the specified role
|
*/
Route::filter('hasRole', function($route, $request, $value)
{
	$user = Authority::getCurrentUser();

	// If not logged in or user does not have role
	if( ! Auth::check() OR ! $user->hasRole($value) )
	{
		return App::abort(403, 'You must be assigned the role "'.$value.'" for this request');
	}
});