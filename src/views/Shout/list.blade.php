@if (!count($shouts))
	<p>No shouts to show!</p>
@else
	@foreach ($shouts as $shout)
		<?php $date = new ExpressiveDate($shout->created_at); ?>
		<div class="shout-post-item">
			<img src="{{ $shout->user->avatar }}">
			{{ link_to_route('user.show', $shout->user->username, $shout->user->id) }}:
			<span>{{{ $shout->content }}}</span>
			@if( Authority::can('manage', 'shout'))
				<span class="pull-right shout-moderation">
					{{ Button::inverse_link(URL::route('shout.pin', array('shout' => $shout->id)), 'Pin') }}
					{{ HTML::resourceDelete('shout', $shout->id, 'Delete') }}
				</span>
			@endif
			<span class="pull-right" title="{{ $date }}">
				{{ $date->getRelativeDate() }}
			</span>
			@if ($shout->pinned)
				<i class="icon-star icon-white pull-right" title="This post has been pinned"></i>
			@endif
		</div>
	@endforeach
	{{ $shouts->links() }}
@endif