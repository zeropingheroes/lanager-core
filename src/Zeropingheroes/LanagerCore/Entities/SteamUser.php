<?php
namespace Zeropingheroes\LanagerCore\Entities;

class SteamUser {

	/*
	 * Basic information
	 */
	public $id;
	public $creation_time;
	public $username;
	public $real_name;
	public $avatar_url;
	public $primary_group_id;

	/*
	 * Current status
	 */
	public $status;
	public $last_online_time;
	public $current_app_id;
	public $current_app_name;
	public $current_server_ip;


	/*
	 * Location
	 */
	public $location_city_id;
	public $location_country_code;
	public $location_state_code;

	/**
	 * Get the URL for the user's medium avatar.
	 *
	 * @return string
	 */
	public function getMediumAvatarUrl()
	{
		return str_replace('.jpg', '_medium.jpg', $this->avatar_url);
	}

	/**
	 * Get the URL for the user's large avatar.
	 *
	 * @return string
	 */
	public function getLargeAvatarUrl()
	{
		return str_replace('.jpg', '_full.jpg', $this->avatar_url);
	}

	/**
	 * Translate the user's status number to English
	 *
	 * @return string
	 */
	public function getStatus()
	{
		switch ($this->status)
		{
			case '1':
				return 'Online';
			case '2':
				return 'Busy';
			case '3':
				return 'Away';
			case '4':
				return 'Snooze';
			case '5':
				return 'Looking to trade';
			case '6':
				return 'Looking to play';
			case '0':
			default:
			return 'Offline'; // TODO: Return e.g. "last online 15 minutes ago"
		}
	}

}