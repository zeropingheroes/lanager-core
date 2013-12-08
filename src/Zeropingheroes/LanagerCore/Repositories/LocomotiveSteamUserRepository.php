<?php
namespace Zeropingheroes\LanagerCore\Repositories;

use Config;
use Zeropingheroes\LanagerCore\Entities\SteamUser;
use \Locomotive;

class LocomotiveSteamUserRepository implements SteamUserRepositoryInterface {

	protected $steamApi;

	public function __construct()
	{
		$this->steamApi = new Locomotive(Config::get('lanager-core::steamWebApiKey'));
	}

	/**
	 * Get a single SteamUser by ID
	 *
	 * @param  string   $id
	 * @return object SteamUser|null
	 */
	public function getUser($id)
	{
		$steamUsers = $this->getUsers(array($id));
		if(count($steamUsers) == 1)
		{
			return $steamUsers[0];
		}
		else
		{
			return NULL;
		}
	}

	/**
	 * Get many SteamUsers by ID
	 *
	 * @param  array   $ids
	 * @return array
	 */
	public function getUsers(array $ids)
	{
		$profiles = $this->steamApi->ISteamUser->GetPlayerSummaries($ids);
		foreach ($profiles->response->players as $profile)
		{
			$steamUser = new SteamUser;

			// Present on all profiles
			$steamUser->id			= $profile->steamid;
			$steamUser->username	= $profile->personaname;
			$steamUser->real_name	= $profile->realname;

			// Optional
			if (isset($profile->timecreated))		$steamUser->creation_time			= $profile->timecreated;
			if (isset($profile->avatar))			$steamUser->avatar_url				= $profile->avatar;
			if (isset($profile->primaryclanid))		$steamUser->primary_group_id		= $profile->primaryclanid;
			if (isset($profile->personastate))		$steamUser->status					= $profile->personastate;
			if (isset($profile->lastlogoff))		$steamUser->last_online_time		= $profile->lastlogoff;
			if (isset($profile->gameextrainfo))		$steamUser->current_app_name		= $profile->gameextrainfo;
			if (isset($profile->gameserverip))		$steamUser->current_server_ip		= $profile->gameserverip;
			if (isset($profile->loccityid))			$steamUser->location_city_id		= $profile->loccityid;
			if (isset($profile->loccountrycode))	$steamUser->location_country_code	= $profile->loccountrycode;
			if (isset($profile->locstatecode))		$steamUser->location_state_code		= $profile->locstatecode;
			if (isset($profile->gameid))			$steamUser->current_app_id			= $profile->gameid;

			$steamUsers[] = $steamUser;
		}
		
		if(isset($steamUsers))
		{
			return $steamUsers;
		}
		else
		{
			return array();
		}
	}

}