<?php

/*
|--------------------------------------------------------------------------
| Application Bindings
|--------------------------------------------------------------------------
|
| Here is where you can choose a repository implementation for
| a given repository interface.
|
*/

App::bind(
	'Zeropingheroes\LanagerCore\Repositories\SteamUserRepositoryInterface',
	'Zeropingheroes\LanagerCore\Repositories\LocomotiveSteamUserRepository'
	);

App::bind(
	'Zeropingheroes\LanagerCore\Repositories\StateRepositoryInterface',
	'Zeropingheroes\LanagerCore\Repositories\EloquentStateRepository'
	);