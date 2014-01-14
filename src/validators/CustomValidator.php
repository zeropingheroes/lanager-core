<?php namespace Zeropingheroes\LanagerCore\Validators;

use ExpressiveDate;
use Config, Auth;

class CustomValidator extends \Illuminate\Validation\Validator {

	public function validateFloodProtect($attribute, $value, $parameters)
	{
		$date = new ExpressiveDate;
		$date->minusSeconds(Config::get('lanager-core::floodProtect.shouts'));
		return ! Auth::user()->shouts()->where('created_at','>',$date)->count();
	}

}