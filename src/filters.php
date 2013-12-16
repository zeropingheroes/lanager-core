<?php

/*
|--------------------------------------------------------------------------
| First Time Install Filter
|--------------------------------------------------------------------------
|
| The "installed" filter checks if the app has been marked as installed.
|
*/

Route::filter('installed', function()
{
	if (Config::get('lanager-core::installationCompleted') != true ) return Redirect::to('install');
});


/*
|--------------------------------------------------------------------------
| Authority Filter
|--------------------------------------------------------------------------
|
| The "installed" filter checks if the remote user can perform the requested
| action on the specified resource.
|
*/
Route::filter('authority', function($route, $request)
{
	// Get request details
	$routeName = explode('.', Route::currentRouteName());
	$resource = $routeName[0];
	$action = $routeName[1];
	$item = $route->getParameter($resource);

	// Replace laravel-style route action names with their CRUD equivalents
	$actionsToReplace = array('store', 'show', 'index', 'edit', 'destroy');
	$replaceWithAction = array('create', 'read', 'read', 'update', 'delete');
	$action = str_replace($actionsToReplace, $replaceWithAction, $action);

	// Check if user is forbidden from performing $action on $resource $item
	if(Authority::cannot($action, $resource, $item))
	{
		return App::abort(403, 'You do not have permission to '.$action.' '.$resource.' '.$item);
	}
});

