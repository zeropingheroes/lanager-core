<?php namespace Zeropingheroes\LanagerCore;

use Zeropingheroes\LanagerCore\Models\State,
	Zeropingheroes\LanagerCore\Repositories\StateRepositoryInterface;
use View;
class StateController extends BaseController {

	protected $states;
	
	public function __construct(StateRepositoryInterface $states)
	{
		$this->states = $states;
	}

	/**
	 * Display applications currently in use.
	 *
	 * @return Response
	 */
	public function currentApplicationUsage()
	{
		$applications = $this->states->getCurrentApplicationUsage();
		return View::make('lanager-core::state.usage')
					->with('title','Games Currently Being Played')
					->with('itemsInUse',$applications);
	}

	/**
	 * Display servers currently in use.
	 *
	 * @return Response
	 */
	public function currentServerUsage()
	{
		$servers = $this->states->getCurrentServerUsage();
		return View::make('lanager-core::state.usage')
					->with('title','Game Servers Currently Being Used')
					->with('itemsInUse',$servers);
	}

}