@extends('lanager-core::layouts.default')
@section('content')
<?php $steamState = $user->steamStates()->latest(); ?>
<div class="user_show_header">
	<img class="user_show_avatar_large" src="{{ $user->getLargeAvatarUrl() }}">
	<span class="user_show_username">{{{ $user->username }}}</span>
	<ul class="user_show_tools">
		<li><a href="{{ SteamBrowserProtocol::addFriend($user->steam_id_64) }}">Add</a></li>
		<li><a href="{{ SteamBrowserProtocol::messageFriend($user->steam_id_64) }}">Message</a></li>
		<li><a href="http://www.steamcommunity.com/profiles/{{ $user->steam_id_64 }}" target="_blank">View Steam Profile</a></li>
	</ul>
</div>
<div class="user_show_content">
	<div class="user_show_status pull-right">
		{{ $steamState->getStatus() }}
		@if( is_numeric($steamState->app_id) )
			:
			<a href="{{ SteamBrowserProtocol::viewAppInStore($steamState->app_id) }}">
				{{{ $steamState->app_name }}}<br>
				<img src="http://cdn.steampowered.com/v/gfx/apps/{{ $steamState->app_id }}/capsule_184x69.jpg"></a>
			<br>
			@if( !empty($steamState->server_ip) )
				{{ link_to(SteamBrowserProtocol::connectToServer($steamState->server_ip), 'Join') }}
			@endif
		@endif
	</div>
	<br>
</div>
@endsection