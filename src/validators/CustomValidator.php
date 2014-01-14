<?php namespace Zeropingheroes\LanagerCore\Validators;

use ExpressiveDate;
use Config, Auth;

class CustomValidator extends \Illuminate\Validation\Validator {

	public function validateFloodProtect($attribute, $value, $parameters)
	{
		$date = new ExpressiveDate;
		$date->minusSeconds(Config::get('lanager-core::floodProtect.'.$parameters[0]));
		return ! Auth::user()->{$parameters[0]}()->where('created_at','>',$date)->count();
	}

}