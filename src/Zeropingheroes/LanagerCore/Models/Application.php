<?php
namespace Zeropingheroes\LanagerCore\Models;

use Tsukanov\SteamLocomotive\Core\Tools\Store;

class Application extends BaseModel {

	public function states()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\State');
	}

	public function servers()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\Server');
	}

	public function getLogo($size = 'small')
	{
		if( ! empty($this->steam_app_id) )
		{
			$locomotive = new Store();
			return $locomotive->getAppLogoURL($this->steam_app_id, $size);			
		}
		else
		{
			return ''; // Todo - logo support for non-steam apps
		}

	}

}