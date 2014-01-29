<?php
namespace Zeropingheroes\LanagerCore\Models;

use SteamBrowserProtocol;

class Server extends BaseModel {
	
	public function application()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\Application');
	}
	
	public function states()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\State');
	}

	public function getFullAddress()
	{
		if( $this->address && $this->port)
		{
			return $this->address.':'.$this->port;
		}
		if( $this->address )
		{
			return $this->address;
			// Todo: add support for default application ports
		}
	}

	public function getUrl()
	{
		if( ! empty($this->application->steam_app_id) )
		{
			return SteamBrowserProtocol::connectToServer($this->getFullAddress());
		}
		// Todo: add support for non-steam app connection URLs
	}
}