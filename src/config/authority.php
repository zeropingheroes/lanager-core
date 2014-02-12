<?php

return array(

	'initialize' => function($authority)
	{
		// Allowed verbs:   create, read, update, delete
		// Allowed aliases: manage

		// Add an alias for full resourceful CRUD
		$authority->addAlias('manage', array('create', 'read', 'update', 'delete'));

		// Get the currently logged in user
		$self = $authority->getCurrentUser();

		// If there is a user currently logged in, assign permissions based on roles
		if( is_object($self) )
		{
			$authority->allow('create', 'shout');

			$authority->allow('delete', 'user', function($self, $user){
				if(is_object($user))
				{
					return $self->getCurrentUser()->id === $user->id; // passed entire user object
				}
				else
				{
					return $self->getCurrentUser()->id === $user; // just passed user id
				}
			});
			
			if( $self->hasRole('InfoPageAdmin') ) 
			{
				$authority->allow('manage', 'infoPage');
			}

			if( $self->hasRole('ShoutAdmin') ) 
			{
				$authority->allow('manage', 'shout');
			}

			if( $self->hasRole('EventAdmin') ) 
			{
				$authority->allow('manage', 'event');
			}

			// Must be at bottom
			if( $self->hasRole('SuperAdmin') ) 
			{
				$authority->allow('manage', 'all');
			}
		}
	}
);