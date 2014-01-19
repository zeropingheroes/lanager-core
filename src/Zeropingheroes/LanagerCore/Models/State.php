<?php
namespace Zeropingheroes\LanagerCore\Models;

use Illuminate\Auth\UserInterface;

class State extends BaseModel
{
	public function user()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\User');
	}

	public function application()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\Application');
	}

	public function server()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\Server');
	}

	/**
	 * Translate the status code to English
	 *
	 * @return string
	 */
	public function getStatus()
	{
		switch ($this->status)
		{
			case '1':
				if( !empty($this->application_id) ) return 'In Game'; // Online AND In-game != Online AND away
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