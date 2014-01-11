<?php namespace Zeropingheroes\LanagerCore;

use Zeropingheroes\LanagerCore\Models\Shout;
use Input, Redirect, View, Auth;

class ShoutController extends BaseController {

	public function __construct()
	{
		// Check if user can access requested method
		$this->beforeFilter('checkResourcePermission',array('only' => array('create', 'store', 'edit', 'update', 'destroy') ));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shouts = Shout::orderBy('created_at', 'desc')->paginate(10);
		return View::make('lanager-core::shout.index')
					->with('title', 'Shouts')
					->with('shouts', $shouts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$shout = new Shout;
		$shout->user_id = Auth::user()->id;
		$shout->content = Input::get('content');

		if( ! $shout->save() )
		{
			//dd($shout->validationErrors);
			return Redirect::route('shout.index')->withErrors($shout->validationErrors);
		}
		else
		{
			return Redirect::route('shout.index');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}