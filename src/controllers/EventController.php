<?php namespace Zeropingheroes\LanagerCore;

use Zeropingheroes\LanagerCore\Models\Event;
use View, Input, Redirect, Request, Response, URL;

class EventController extends BaseController {

	
	public function __construct()
	{
		// Check if user can access requested method
		$this->beforeFilter('checkResourcePermission',array('only' => array('create', 'store', 'edit', 'update', 'destroy') ));
	}

	/**
	 * Display the events in a timetable.
	 *
	 * @return Response
	 */
	public function timetable()
	{
		if (Request::ajax()) {
			$events = Event::all();
			
			//format JSON for FullCalendar
			foreach($events as $event)
			{
				$fullCalendarJson[] = array(
					'start'		=> strtotime($event->start),
					'end'		=> strtotime($event->end),
					'title'		=> $event->name,
					'allDay'	=> false,
					'url'		=> URL::route('event.show', $event->id),
					'color'		=> $event->eventType->colour
					);
			}
			return Response::json($fullCalendarJson);
		}
		return View::make('lanager-core::event.timetable')
					->with('title','Events Timetable');
	}

}