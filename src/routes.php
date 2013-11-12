<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



Route::resource('info', 'Zeropingheroes\LanagerCore\InfoPageController');


Route::get('/', function()
{
	return Redirect::to('info');
});



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