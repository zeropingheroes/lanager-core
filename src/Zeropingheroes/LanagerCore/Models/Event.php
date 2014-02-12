<?php
namespace Zeropingheroes\LanagerCore\Models;
use Carbon\Carbon;

class Event extends BaseModel {

	public static $rules = array(
		'name'			=> 'required|max:255',
		'start'			=> 'required|date_format:d/m/Y H:i',
		'end'			=> 'required|date_format:d/m/Y H:i|date_not_before_this_input:start',
		'event_type_id'	=> 'numeric|exists:event_types,id'
	);

	public function eventType()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\EventType');
	}

	public function beforeSave()
	{
		// Convert from UK date format
		$this->start = Carbon::createFromFormat('d/m/Y H:i',$this->start);
		$this->end = Carbon::createFromFormat('d/m/Y H:i',$this->end);
	}

}