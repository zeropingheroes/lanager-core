<?php
namespace Zeropingheroes\LanagerCore\Models;


class Shout extends BaseModel {

	public static $rules = array(
		'content'		=> 'required|max:140|flood_protect',
	);
	public static $customMessages = array(
		'flood_protect' => 'You have posted too recently. Please wait a while and try again.',
	);
	public function user()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\User');
	}

}