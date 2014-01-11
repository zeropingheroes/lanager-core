@if (empty($shouts))
	<p>No shouts to show!</p>
@else
	@foreach ($shouts as $shout)
		<?php $date = new ExpressiveDate($shout->created_at); ?>
		<div class="shout-post">
			<img src="{{ $shout->user->avatar }}">
			{{ link_to_route('user.show', $shout->user->username, $shout->user->id) }}:
			<span class="shout-post-content">{{{ $shout->content }}}</span>
			<span class="shout-post-time" title="{{ $date }}">{{ $date->getRelativeDate() }}</span>
		</div>
	@endforeach
	{{ $shouts->links() }}
@endif