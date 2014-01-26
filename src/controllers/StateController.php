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
		return View::make('lanager-core::state.application.usage')
					->with('title','Games Currently Being Played')
					->with('applications',$applications);
	}

}