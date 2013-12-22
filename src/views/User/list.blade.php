@extends('lanager-core::layouts.default')
@section('content')
<h2>{{{ $title }}}</h2>
	{{ Table::open() }}
	@foreach ($users as $user)
		<?php
		// Get steam state for user if one exists
		$steamState = $user->steamStates()->latest();
		$status = (count($user->steamStates)) ? $steamState->getStatus() : '';
		$appLink = (!empty($steamState->app_id)) ? link_to(SteamBrowserProtocol::viewAppInStore($steamState->app_id), $steamState->app_name) : '';
		$connectLink = (!empty($steamState->server_ip)) ? link_to(SteamBrowserProtocol::connectToServer($steamState->server_ip), $steamState->server_ip) : '';

		$tableBody[] = array(
			'user'		=> '<img src="'.$user->avatar.'"> '.link_to_route('user.show', $user->username, $user->id),
			'status'	=> $status,
			'app'		=> $appLink,
			'server'	=> $connectLink,
			);
		?>
	@endforeach
	{{ Table::body($tableBody) }}
	{{ Table::close() }}
	{{ $users->links() }}
@endsection