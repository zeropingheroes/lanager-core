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