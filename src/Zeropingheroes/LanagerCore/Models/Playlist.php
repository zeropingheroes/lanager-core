<?php
namespace Zeropingheroes\LanagerCore\Models;

class Playlist extends BaseModel
{
	public function playlistItems()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\PlaylistItem');
	}
}