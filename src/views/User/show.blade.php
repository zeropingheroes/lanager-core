@extends('lanager-core::layouts.default')
@section('content')
<?php $steamState = $user->steamStates()->latest(); ?>
<div class="user_show_header">
	<img class="user_show_avatar_large" src="{{ $user->getLargeAvatarUrl() }}">
	<h1 class="user_show_username">{{{ $user->username }}}</h1>
	<ul class="user_show_tools">
		@if( Auth::check() && $user->id == Auth::user()->id )
			<li>{{ Button::inverse_link(SteamBrowserProtocol::openSteamPage('SteamIDEditPage'),'Edit Profile') }}</li>
			<li>{{ HTML::resourceDelete('user',$user->id,'Delete Account') }}</li>
		@else
			<li>{{ Button::inverse_link(SteamBrowserProtocol::addFriend($user->steam_id_64), 'Add') }}</li>
			<li>{{ Button::inverse_link(SteamBrowserProtocol::messageFriend($user->steam_id_64), 'Message') }}</li>
			<li>{{ Button::inverse_link('http://www.steamcommunity.com/profiles/'.$user->steam_id_64, 'View Steam Profile', array('target' => '_blank')) }}</li>
		@endif
	</ul>
</div>
<div class="user_show_content">
	<div class="user_show_status pull-right">
		@if(count($user->steamStates))
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
		@endif
	</div>

	@if( count($user->roles) )
		<h2>Roles</h2>
		<ul>
			@foreach($user->roles as $role)
				<li>{{{ $role->name }}}</li>
			@endforeach
		</ul>
	@endif

	@if( Authority::can( 'manage', 'user' ) )
		<h2>Administration</h2>
		<ul class="user-show-admin">
			<li>{{ Button::inverse_link(URL::route('user.roles.edit', $user->id), 'Manage Roles' ) }}</li>
		</ul>
	@endif

</div>
@endsection