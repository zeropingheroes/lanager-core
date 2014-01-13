<?php

Validator::extend('flood_protect', function($attribute, $value, $parameters)
{
	$date = new ExpressiveDate;
	$date->minusSeconds(Config::get('lanager-core::floodProtect.shouts'));
	return ! Auth::user()->shouts()->where('created_at','>',$date)->count();

});