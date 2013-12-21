<?php
namespace Zeropingheroes\LanagerCore\Models;

use Illuminate\Auth\UserInterface;

class SteamState extends BaseModel
{
	public function user()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\User');
	}

	/**
	 * Translate the status code to English
	 *
	 * @return string
	 */
	public function getStatus()
	{
		switch ($this->status_code)
		{
			case '1':
				if( !empty($this->app_id) ) return 'In Game';
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

	/**
	 * Get the most recent Steam state
	 *
	 * @return Query
	 */
	public function scopeLatest($query)
	{
		return $query->orderBy('created_at', 'desc')->first();
	}
}