@extends('lanager-core::layouts.default')
@section('content')
<div class="user_show_header">
	<img class="user_show_avatar_large" src="{{ $steamUser->getLargeAvatarUrl() }}">
	<span class="user_show_username">{{{ $user->username }}}</span>
	<ul class="user_show_tools">
			<li><a href="{{ $steamUser->getAddFriendLink() }}">Add</a></li>
			<li><a href="{{ $steamUser->getSendMessageLink() }}">Message</a></li>
			<li><a href="{{ $steamUser->getCommunityProfileLink() }}" target="_blank">View Steam Profile</a></li>
	</ul>
</div>
<div class="user_show_content">
	<div class="user_show_status pull-right">
		{{{ $steamUser->getStatus() }}}
	</div>
	<br>
</div>
@endsection