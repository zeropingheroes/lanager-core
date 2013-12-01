<?php
/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
*/

View::composer('lanager-core::layouts.default.info', function($view)
{
    $infoPagesMenuItems = Zeropingheroes\LanagerCore\Models\InfoPage::whereNull('parent_id')->get();

    $view->with('infoPages', $infoPagesMenuItems);

});

View::composer('lanager-core::layouts.default.nav', function($view)
{

	// Steam OpenID Login URL - cached for 1 day due to request time
	$authUrl = Cache::remember('authUrl', 60*24, function()
	{
		$openId = new LightOpenID(Request::server('HTTP_HOST'));
		
		$openId->identity = 'http://steamcommunity.com/openid';
		$openId->returnUrl = URL::route('user.openIdLogin');
		return $openId->authUrl();
	});

	$view->with('authUrl', $authUrl);

});