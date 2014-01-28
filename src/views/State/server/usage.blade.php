@extends('lanager-core::layouts.default')
@section('content')
	<h2>{{{ $title }}}</h2>
@if(count($servers))
	
	{{ Table::open(array('class' => 'state-usage')) }}

	<?php
		foreach ( $servers as $server )
		{
			$users = array();

			foreach ( $server['users'] as $user )
			{
				$users[] = link_to_route('user.show', $user->username, $user->id);
			}

			$application = '<a href="'.SteamBrowserProtocol::viewAppInStore($server['application']->steam_app_id).'">
					<img src="'.$server['application']->getLogo().'" alt="Game Logo" title="'.$server['application']->name.'"></a>';

			$address = $server['address'].':'.$server['port'];
			$address = '<a href="'.SteamBrowserProtocol::connectToServer( $address ).'">'.$address.'</a>';

			$tableBody[] = array(
				'application'	=> $application,
				'user-count'	=> count($users),
				'address'		=> $address,
				'users'			=> implode(', ', $users),
				);
		}
	?>
	{{ Table::body($tableBody) }}

	{{ Table::close() }}

@else
	<p>No servers to show!</p>
@endif
@endsection