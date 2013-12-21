<?php
namespace Zeropingheroes\LanagerCore\Models;

use Illuminate\Auth\UserInterface;

class SteamState extends BaseModel
{
	public function user()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\User', 'users', 'steam_id_64', 'steam_id_64');
	}
}