@if (!count($shouts))
	<p>No shouts to show!</p>
@else
	@foreach ($shouts as $shout)
		<?php $date = new ExpressiveDate($shout->created_at); ?>
		<div class="shout-post-item">
			<img src="{{ $shout->user->avatar }}" alt="Avatar">
			{{ link_to_route('user.show', $shout->user->username, $shout->user->id) }}
			@if( Authority::can('manage', 'shout'))
				<div class="shout-post-moderation pull-right">
					{{ Button::link(URL::route('shout.pin', array('shout' => $shout->id)), 'Pin') }}
					{{ HTML::resourceDelete('shout', $shout->id, 'Delete') }}
				</div>
			@endif
			<span class="shout-post-time pull-right" title="{{ $date }}">
				{{ $date->getRelativeDate() }}
			</span>
			@if ($shout->pinned)
				<span class="glyphicon glyphicon-star-empty pull-right" title="This post has been pinned"></span>
			@endif
			<div class="shout-post-item-content">{{{ $shout->content }}}</div>

		</div>
	@endforeach
	{{ $shouts->links() }}
@endif