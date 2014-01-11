@if (empty($shouts))
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
					{{ HTML::resourceDelete('shout', $shout->id, 'Delete') }}
				</span>
			@endif
			<span class="pull-right" title="{{ $date }}">{{ $date->getRelativeDate() }}</span>
		</div>
	@endforeach
	{{ $shouts->links() }}
@endif