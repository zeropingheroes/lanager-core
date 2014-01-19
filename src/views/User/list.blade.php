@extends('lanager-core::layouts.default')
@section('content')
	<h2>{{{ $title }}}</h2>
	@if(count($users))
		{{ Table::open() }}

		<?php
			$i = 0;
			foreach( $users as $user )
			{
				// Reset variables
				$status	= NULL;
				$application = NULL;
				$server = NULL;
				$avatarClass = 'offline';

				// Get user's most recent state
				$state = $user->states()->latest();
				
				// If user has a state
				if( $state->first() )
				{
					$status = $state->getStatus();
					if( $state->status )
					{
						$avatarClass = 'online';
					}
					// If user is running a Steam application
					if ( isset($state->application->steam_app_id) )
					{
						$application = link_to( SteamBrowserProtocol::viewAppInStore( $state->application->steam_app_id ), $state->application->name );
						$avatarClass = 'in-game';

						// If user is connected to a server 
						if ( isset($state->server->address) )
						{
							$server = link_to( SteamBrowserProtocol::connectToServer( $state->server->getFullAddress() ), $state->server->getFullAddress() );
						}
					}
				}

				$tableBody[] = array(
					'user'			=> '<a class="pull-left" href="'.URL::route('user.show', $user->id).'">
											<img src="'.$user->avatar.'" class="avatar '.$avatarClass.'" alt="Avatar"> '.$user->username.'
										</a>',
					'status'		=> $status,
					'application'	=> $application,
					'server'		=> $server,
				);

				$i++;
			}
		?>
		{{ Table::body($tableBody) }}
		{{ Table::close() }}
		{{ $users->links() }}
	@else
		No users found!
	@endif
@endsection