@if (!count($shouts))
	<p>No shouts to show!</p>
@else
	@foreach ($shouts as $shout)
		<?php
			$date = new ExpressiveDate($shout->created_at);
			$avatarClass = 'offline';
			$avatarTitle = NULL;
		?>
		<div class="media">
			<a class="pull-left" href="{{ URL::route('user.show', $shout->user->id) }}">
				<?php 
					$state = $shout->user->states()->latest();
					if( $state->first() )
					{
						// If user is in-game alter their avatar
						if( isset( $state->application->name ) )
						{
							$avatarClass = 'in-game';
							$avatarTitle = 'In-Game: '.e($state->application->name);
						}
						else
						{
							if( $state->status )
							{
								$avatarClass = 'online';
							}
							$avatarTitle = $state->getStatus();
						}
					}
				?>
				<img
					class="media-object avatar {{ $avatarClass }}"
					src="{{ $shout->user->avatar }}"
					alt="Avatar"
					title="{{ $avatarTitle }}"
					>
			</a>
			@if( Authority::can('manage', 'shout'))
				<div class="shout-moderation pull-right">
					{{ Button::link(URL::route('shout.pin', array('shout' => $shout->id)), 'Pin') }}
					{{ HTML::resourceDelete('shout', $shout->id, 'Delete') }}
				</div>
			@endif
			<span class="pull-right shout-timestamp" title="{{ $date }}">
				{{ $date->getRelativeDate() }}
			</span>
			@if ($shout->pinned)
				<span class="glyphicon glyphicon-star pull-right" title="This post has been pinned"></span>
			@endif
			<div class="media-body shout-body">
				<h4 class="media-heading">
					{{ link_to_route('user.show', $shout->user->username, $shout->user->id) }}
					@foreach($shout->user->roles as $role)
						<span class="badge">{{ $role->name }}</span>
					@endforeach
				</h4>
				{{{ $shout->content }}}
			</div>
		</div>
	@endforeach
@endif