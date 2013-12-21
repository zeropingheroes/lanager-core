@extends('lanager-core::layouts.default')
@section('content')
<h2>{{{ $title }}}</h2>
	{{ Table::open() }}
	@foreach ($users as $user)
		<?php
		$steamState = $user->steamStates()->latest();
		$appLink = ($steamState->app_id) ? link_to(SteamBrowserProtocol::viewAppInStore($steamState->app_id), $steamState->app_name) : '';
		$connectLink = ($steamState->server_ip) ? link_to(SteamBrowserProtocol::connectToServer($steamState->server_ip), $steamState->server_ip) : '';
		$tableBody[] = array(
			'user'		=> '<img src="'.$user->avatar.'"> '.link_to_route('user.show', $user->username, $user->id),
			'status'	=> $steamState->getStatus(),
			'app'		=> $appLink,
			'server'	=> $connectLink,
			);
		?>
	@endforeach
	{{ Table::body($tableBody) }}
	{{ Table::close() }}
	{{ $users->links() }}
@endsection