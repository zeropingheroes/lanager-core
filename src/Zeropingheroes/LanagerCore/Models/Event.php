<?php
namespace Zeropingheroes\LanagerCore\Models;

class Event extends BaseModel {

	public function eventType()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\EventType');
	}

}