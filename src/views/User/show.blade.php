@extends('lanager-core::layouts.default')
@section('content')
<?php $steamState = $user->steamStates()->latest(); ?>
<div class="user-profile-header">
	<img src="{{ $user->getLargeAvatarUrl() }}">
	<h1>{{{ $user->username }}}</h1>
	<ul class="user-profile-actions pull-right">
		@if( Auth::check() && $user->id == Auth::user()->id )
			<li>{{ Button::link(SteamBrowserProtocol::openSteamPage('SteamIDEditPage'),'Edit Profile') }}</li>
			<li>{{ HTML::resourceDelete('user',$user,'Delete Account') }}</li>
		@else
			<li>{{ Button::link(SteamBrowserProtocol::addFriend($user->steam_id_64), 'Add') }}</li>
			<li>{{ Button::link(SteamBrowserProtocol::messageFriend($user->steam_id_64), 'Message') }}</li>
			<li>{{ Button::link('http://www.steamcommunity.com/profiles/'.$user->steam_id_64, 'View Steam Profile', array('target' => '_blank')) }}</li>
		@endif
	</ul>
</div>
<div class="user-profile-content">
	<div class="user-status pull-right">
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

	@if( count($user->shouts) )
		<?php $shouts = $user->shouts()->orderBy('created_at','desc')->take(Config::get('lanager-core::userProfile.shoutQuantity'))->get(); ?>
		<h2>Shouts</h2>
		@include('lanager-core::shout.list')
	@endif

	@if( count($user->roles) )
		<h2>Roles</h2>
		<ul>
			@foreach($user->roles as $role)
				<li>{{{ $role->name }}}</li>
			@endforeach
		</ul>
	@endif

	@if( Authority::can( 'manage', 'user', $user ) )
		<h2>Administration</h2>
		<ul>
			<li>{{ Button::link(URL::route('user.roles.edit', $user->id), 'Manage Roles' ) }}</li>
			<li>{{ HTML::resourceDelete('user',$user,'Delete User') }}</li>
		</ul>
	@endif

</div>
@endsection