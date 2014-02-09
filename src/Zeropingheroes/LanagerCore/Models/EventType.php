<?php
namespace Zeropingheroes\LanagerCore\Models;

class EventType extends BaseModel {

	public function event()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\Event');
	}

}