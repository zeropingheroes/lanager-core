<?php
namespace Zeropingheroes\LanagerCore\Repositories;

use Config;
use Zeropingheroes\LanagerCore\Models\State;

class EloquentStateRepository implements StateRepositoryInterface {

	protected $maximumAge;

	public function __construct()
	{
		$this->maximumAge = Config::get('lanager-core::states.maximumAge');
	}

	/**
	 * Generate foundation query for latest states
	 *
	 * @return object QueryBuilder
	 */
	protected function currentStates()
	{
		return State::select('states.*')
							->leftJoin('states as t2', function($join)
							{
								$join->on('states.user_id', '=', 't2.user_id')
									 ->on('states.created_at', '<', 't2.created_at');
							})->whereNull('t2.user_id')
							->where('states.created_at', '>=', date('Y-m-d H:i:s',time()-$this->maximumAge))
							->with('application', 'user', 'server');
	}

	/**
	 * Get current states for specified user(s)
	 *
	 * @param  object|array   $users|null
	 * @return array|object State
	 */
	public function getCurrentUserStates( $users = null)
	{
		// No user(s) specified
		if( ! $users )
		{
			return $this->currentStates()->get();
		}
		
		// One user specified
		if( is_object($users) )
		{
			return $this->currentStates()->where('states.user_id', '=', $users->id)->get();
		}		

		// Several users specified
		if( is_array($users) && count($users) > 1 )
		{
			foreach($users as $user)
			{
				$userIds[] = $user->id;
			}
			return $this->currentStates()->where('states.user_id', '=', $userIds)->get();
		}
	}

	/**
	 * Get applications currently being used by users
	 *
	 * @return array
	 */
	public function getCurrentApplicationUsage()
	{
		$states = $this->currentStates()->whereNotNull('states.application_id')->get();

		if( count($states) )
		{
			// Collect and combine states for the same application
			foreach($states as $state)
			{
				$usage[$state->application_id]['application'] = $state->application;
				$usage[$state->application_id]['users'][] = $state->user;
			}

			// Build clean array of applications
			foreach($usage as $item)
			{
				$applications[] = array(
					'id'				=> $item['application']->id,
					'name'				=> $item['application']->name,
					'steam_app_id'		=> $item['application']->steam_app_id,
					'logo'				=> $item['application']->getLogo(),
					'users'				=> $item['users'],
					);
			}

			// Sort applications array by user count, in decending order
			usort($applications, function($a, $b) {
				return count($b['users']) - count($a['users']);
			});

			return $applications;
		}
		else
		{
			return NULL;
		}
	}


	/**
	 * Get applications currently being used by users
	 *
	 * @return array
	 */
	public function getCurrentServerUsage()
	{
		$states = $this->currentStates()->whereNotNull('states.server_id')->get();

		if( count($states) )
		{
			// Collect and combine states for the same server
			foreach($states as $state)
			{
				$usage[$state->server_id]['server'] = $state->server;
				$usage[$state->server_id]['users'][] = $state->user;
			}

			// Build clean array of servers
			foreach($usage as $item)
			{
				$servers[] = array(
					'id'				=> $item['server']->id,
					'address'			=> $item['server']->address,
					'port'				=> $item['server']->port,
					'application'		=> $item['server']->application,
					'users'				=> $item['users'],
					);
			}

			// Sort applications array by user count, in decending order
			usort($servers, function($a, $b) {
				return count($b['users']) - count($a['users']);
			});

			return $servers;
		}
		else
		{
			return NULL;
		}
	}


}