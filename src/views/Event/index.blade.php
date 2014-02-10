@extends('lanager-core::layouts.default')
@section('content')
	<h2>{{{ $title }}}</h2>
	@if(count($events))
		{{ Table::open() }}
		{{ Table::headers('Name', 'Starts', '', 'Ends', '', 'Type') }}
		<?php
		foreach( $events as $event )
		{
			$tableBody[] = array(
				'name'			=> link_to_route('event.show', $event->name, $event->id),
				'start-day'		=> date('D jS', strtotime($event->start)),
				'start-time'	=> date('g:ia', strtotime($event->start)),
				'end-day'		=> date('D jS', strtotime($event->end)),
				'end-time'		=> date('g:ia', strtotime($event->end)),
				'type'			=> $event->event_type->name,
			);
		}
		?>
		{{ Table::body($tableBody) }}
		{{ Table::close() }}
	@else
		No events found!
	@endif
@endsection