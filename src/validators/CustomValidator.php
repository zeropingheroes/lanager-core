<?php namespace Zeropingheroes\LanagerCore\Validators;

use ExpressiveDate;
use Carbon\Carbon;
use Config, Auth;

class CustomValidator extends \Illuminate\Validation\Validator {

	public function validateFloodProtect($attribute, $value, $parameters)
	{
		$date = new ExpressiveDate;
		$date->minusSeconds(Config::get('lanager-core::floodProtect.'.$parameters[0]));
		return ! Auth::user()->{$parameters[0]}()->where('created_at','>',$date)->count();
	}

	/**
	 * Check to see if end date comes after start date
	 * 
	 * @param  $attribute
	 * @param  $value
	 * @param  $parameters 
	 * @return boolean
	 */
	public function validateDateNotBeforeThisInput($attribute, $value, $parameters)
	{
		$start_date = $this->getValue($parameters[0]); // get the value of the parameter (start_date)

		$start_date = Carbon::createFromFormat('d/m/Y H:i',$start_date)->timestamp;
		$end_date = Carbon::createFromFormat('d/m/Y H:i',$value)->timestamp;

		return ($end_date > $start_date);
	}

}