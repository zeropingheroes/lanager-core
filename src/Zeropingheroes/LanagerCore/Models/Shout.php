<?php
namespace Zeropingheroes\LanagerCore\Models;


class Shout extends BaseModel {

	public static $rules = array(
		'content'		=> 'required|max:140|flood_protect:shouts',
	);
	public function user()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\User');
	}

}