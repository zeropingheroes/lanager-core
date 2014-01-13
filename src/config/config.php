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


);
