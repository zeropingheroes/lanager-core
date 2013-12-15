<?php

return array(

	'initialize' => function($authority)
	{
		// Allowed verbs:   create, read, update, delete
		// Allowed aliases: manage

		// Add an alias for full resourceful CRUD
		$authority->addAlias('manage', array('create', 'read', 'update', 'delete'));

		// Get the currently logged in user
		$user = $authority->getCurrentUser();

		// If there is a user currently logged in, assign permissions based on roles
		if( is_object($user) )
		{
			if( $user->hasRole('SuperAdmin') ) 
			{
				$authority->allow('manage', 'all');
			}
			
			if( $user->hasRole('InfoPageAdmin') ) 
			{
				$authority->allow('manage', 'InfoPage');
			}

		}
	}
);