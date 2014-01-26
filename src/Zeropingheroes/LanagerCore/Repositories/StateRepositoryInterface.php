<?php
namespace Zeropingheroes\LanagerCore\Repositories;

interface StateRepositoryInterface {

	/**
	 * Get current states for specified user(s)
	 *
	 * @param  array   $users|null
	 * @return array|object State
	 */
	public function getCurrentUserStates($users = null);

	/**
	 * Get applications currently being used by users
	 *
	 * @return array
	 */
	public function getCurrentApplicationUsage();

}