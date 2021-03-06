<?php namespace Zeropingheroes\LanagerCore;

use Zeropingheroes\LanagerCore\Models\Event,
	Zeropingheroes\LanagerCore\Models\EventType;
use View, Input, Redirect, Request, Response, URL, Auth;

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
					'color'		=> (isset($event->event_type->colour) ? $event->event_type->colour : ''),
					);
			}
			return Response::json($fullCalendarJson);
		}
		return View::make('lanager-core::event.timetable')
					->with('title','Events Timetable');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Event::orderBy('start')->get();
		
		return View::make('lanager-core::event.index')
					->with('title','Events List')
					->with('events',$events);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$eventTypes = array('' => ' ') + EventType::lists('name','id');
		$event = new Event;
		return View::make('lanager-core::event.create')
					->with('title','Create Event')
					->with('eventTypes',$eventTypes)
					->with('event',$event);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$event = new Event;
		$event->name 			= Input::get('name');
		$event->description 	= Input::get('description');
		$event->start 			= Input::get('start');
		$event->end 			= Input::get('end');
		$event->signup_opens	= (Input::get('signup_opens') != NULL ? Input::get('signup_opens') : NULL);
		$event->signup_closes	= (Input::get('signup_closes') != NULL ? Input::get('signup_closes') : NULL);
		$event->event_type_id 	= (is_numeric(Input::get('event_type_id')) ? Input::get('event_type_id') : NULL); // turn non-numeric & empty values into NULL

		if(!$event->save())
		{
			return Redirect::route('event.create')->withErrors($event->errors());
		}

		return Redirect::route('event.show',array('event' => $event->id));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Event::find($id);

		return View::make('lanager-core::event.show')
					->with('title',$event->name)
					->with('event',$event);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event = Event::find($id);
		$eventTypes = array('' => ' ') + EventType::lists('name','id');

		return View::make('lanager-core::event.edit')
					->with('title','Edit Event')
					->with('eventTypes',$eventTypes)
					->with('event',$event);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$event = Event::find($id);
		$event->name 			= Input::get('name');
		$event->description		= Input::get('description');
		$event->start 			= Input::get('start');
		$event->end 			= Input::get('end');
		$event->signup_opens	= (Input::get('signup_opens') != NULL ? Input::get('signup_opens') : NULL);
		$event->signup_closes	= (Input::get('signup_closes') != NULL ? Input::get('signup_closes') : NULL);
		$event->event_type_id	= (is_numeric(Input::get('event_type_id')) ? Input::get('event_type_id') : NULL); // turn non-numeric & empty values into NULL
		
		if(!$event->save())
		{
			return Redirect::route('event.edit',array('event' => $event->id))->withErrors($event->errors());
		}

		return Redirect::route('event.show',array('event' => $event->id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Event::destroy($id);
		return Redirect::route('event.index');
	}

	public function join($id)
	{
		$event = Event::find($id);
		if( !$event->users->contains(Auth::user()) AND (strtotime($event->signup_closes) > time()) ) 
		{
			$event->users()->attach(Auth::user());
		}
		return Redirect::route('event.show',array('event' => $event->id));
	}

	public function leave($id)
	{
		$event = Event::find($id);
		if( $event->users->contains(Auth::user()) )
		{
			$event->users()->detach(Auth::user());
		}
		return Redirect::route('event.show',array('event' => $event->id));
	}


}