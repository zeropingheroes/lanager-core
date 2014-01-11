@if (empty($shouts))
	<p>No shouts to show!</p>
@else
	@foreach ($shouts as $shout)
		<img src="{{ $shout->user->avatar }}">
		{{ link_to_route('user.show', $shout->user->username, $shout->user->id) }}:
		{{{ $shout->content }}}<br>
	@endforeach
	{{ $shouts->links() }}
@endif