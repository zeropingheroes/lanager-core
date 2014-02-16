@extends('lanager-core::layouts.default')
@section('content')
	<h2>{{{ $title }}}</h2>
	@if(count($events))
		{{ Table::open() }}
		{{ Table::headers('Name', 'Time', 'Type', 'Signups') }}
		<?php
		foreach( $events as $event )
		{
			$eventTimespan = new Zeropingheroes\LanagerCore\Helpers\Timespan($event->start, $event->end);
			if(isset($event->signup_opens))
			{
				$signupTimespan = new Zeropingheroes\LanagerCore\Helpers\Timespan($event->signup_opens, $event->signup_closes);
				switch($signupTimespan->status)
				{
					case 0:
						$signupTimespan->status = Label::info('Not Yet Open');
						break;
					case 1:
						$signupTimespan->status = Label::success('Open');
						break;
					case 2:
						$signupTimespan->status = Label::warning('Closed');
						break;
				}
				$signups = $signupTimespan->status.' '.count($event->users).' '.str_plural('user',count($event->users)).' signed up';
			}
			else
			{
				$signups = '';
			}
			$tableBody[] = array(
				'name'			=> link_to_route('event.show', $event->name, $event->id),
				'time'			=> $eventTimespan->naturalFormat(),
				'type'			=> (isset($event->event_type->name) ? $event->event_type->name : ''),
				'signups'		=> $signups,
			);
		}
		?>
		{{ Table::body($tableBody) }}
		{{ Table::close() }}
	@else
		No events found!
	@endif
@endsection