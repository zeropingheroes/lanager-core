<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Steam Web API Key
	|--------------------------------------------------------------------------
	|
	| To use the LANager you will need to obtain a Steam Web API key
	| Get one here:
	| http://steamcommunity.com/dev/apikey
	|
	|
	*/

	'steamWebApiKey' => '',



	/*
	|--------------------------------------------------------------------------
	| Installation
	|--------------------------------------------------------------------------
	|
	| If the installer has not yet been completed, this will be set to false.
	| If all installation steps have been manually run, this can be set to true.
	| If the app needs to be manually checked and re-installed, set this to false.
	|
	*/

	'installationCompleted'	=> false,



	/*
	|--------------------------------------------------------------------------
	| Flood Protection
	|--------------------------------------------------------------------------
	|
	| You may limit how quickly a logged in user can post new data to the database
	| to prevent spamming. Measured in seconds, and specific to the resource type
	| 
	|
	*/

	'floodProtect' => array(
		'shouts' => 30,
	),



	/*
	|--------------------------------------------------------------------------
	| User Profile
	|--------------------------------------------------------------------------
	|
	| For user profiles you may configure how many of each type of user generated
	| content gets displayed.
	| 
	|
	*/
	'userProfile' => array(
		'shoutQuantity' => 3,
	),


	/*
	|--------------------------------------------------------------------------
	| Maximum State Age
	|--------------------------------------------------------------------------
	|
	| Set the maximum age in seconds of a user state
	| States that are older than this will not be considered "live" and thus
	| not displayed on a user's profile or count towards the "currently in use"
	| statistics pages.
	| Be sure to set this higher than your schedule for collecting states
	|
	*/
	'states' => array(
		'maximumAge' => 300,
	),



	/*
	|--------------------------------------------------------------------------
	| Event Timetable Default Colours
	|--------------------------------------------------------------------------
	|
	| Set the default colour (hex) for events that either don't have a type or
	| types that don't have a colour. 
	|
	*/
	'defaultEventColour' => '#0f6c00',

);
