@extends('lanager-core::layouts.default')
@section('content')
	<h2>{{{ $title }}}</h2>
@if(count($applications))
	
	{{ Table::open(array('class' => 'application-usage')) }}

	<?php
		foreach ( $applications as $application )
		{
			$users = array();

			foreach ( $application['users'] as $user )
			{
				$users[] = link_to_route('user.show', $user->username, $user->id);
			}

			$application = '<a href="'.SteamBrowserProtocol::viewAppInStore($application['steam_app_id']).'">
					<img src="'.$application['logo'].'" alt="Game Logo" title="'.$application['name'].'"></a>';

			$tableBody[] = array(
				'application'	=> $application,
				'user-count'	=> count($users),
				'users'			=> implode(', ', $users),
				);
		}
	?>
	{{ Table::body($tableBody) }}

	{{ Table::close() }}

@else
	<p>No applications to show!</p>
@endif
@endsection