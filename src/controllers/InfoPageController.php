<?php namespace Zeropingheroes\LanagerCore;

use Zeropingheroes\LanagerCore\Models\InfoPage,
\View,
\Input,
\Redirect;

class InfoPageController extends BaseController {

	
	public function __construct()
	{
		// Check if user can access requested method
		$this->beforeFilter('authority',array('only' => array('create', 'store', 'edit', 'update', 'destroy') ));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$infoPages = InfoPage::all();
		
		return View::make('lanager-core::infoPage.index')
					->with('title','Info')
					->with('infoPages',$infoPages);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$infoPagesDropdown = array('' => ' ') + InfoPage::lists('title','id');
		$infoPage = new InfoPage;
		return View::make('lanager-core::infoPage.create')
					->with('title','Create Info Page')
					->with('infoPagesDropdown',$infoPagesDropdown)
					->with('infoPage',$infoPage);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$infoPage = new InfoPage;
		$infoPage->title = Input::get('title');
		$infoPage->content = Input::get('content');
		$infoPage->parent_id = (is_numeric(Input::get('parent_id')) ? Input::get('parent_id') : NULL); // turn non-numeric & empty values into NULL
		
		if(!$infoPage->save())
		{
			return Redirect::route('infoPage.create')->withErrors($infoPage->errors());
		}

		return Redirect::route('infoPage.show',array('infoPage' => $infoPage->id));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$infoPage = InfoPage::find($id);
		$infoPageChildren = InfoPage::where('parent_id',$id)->get();

		return View::make('lanager-core::infoPage.show')
					->with('title',$infoPage->title)
					->with('infoPages',$infoPageChildren)
					->with('infoPage',$infoPage);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$infoPage = InfoPage::find($id);
		$infoPagesDropdown = array('' => ' ') + InfoPage::lists('title','id');
		return View::make('lanager-core::infoPage.edit')
					->with('title','Edit Info Page')
					->with('infoPagesDropdown',$infoPagesDropdown)
					->with('infoPage',$infoPage);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$infoPage = InfoPage::find($id);
		$infoPage->title = Input::get('title');
		$infoPage->content = Input::get('content');
		$infoPage->parent_id = (is_numeric(Input::get('parent_id')) ? Input::get('parent_id') : NULL); // turn non-numeric & empty values into NULL
		
		if(!$infoPage->save())
		{
			return Redirect::route('infoPage.edit',array('infoPage' => $infoPage->id))->withErrors($infoPage->errors());
		}

		return Redirect::route('infoPage.show',array('infoPage' => $infoPage->id));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		InfoPage::destroy($id);
		return Redirect::route('infoPage.index');

	}

}