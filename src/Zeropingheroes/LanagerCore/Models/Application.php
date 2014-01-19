<?php
namespace Zeropingheroes\LanagerCore\Models;


class Application extends BaseModel {

	public function states()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\State');
	}

	public function servers()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\Server');
	}

}