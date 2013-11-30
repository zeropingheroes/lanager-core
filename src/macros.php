<?php

/*
|--------------------------------------------------------------------------
| Application HTML Macros
|--------------------------------------------------------------------------
|
| Here is where you can register your HTML macros.
|
*/

// Validation errors wrapped in bootstrap style
HTML::macro('validationErrors', function($errors)
{
	if( $errors->count() > 0 )
	{
		return Alert::error(
			'<strong>The following errors occurred</strong>
			<ul>
				'.implode($errors->all('<li>:message</li>')).'
			</ul>'
		);
	}
});

/*
|--------------------------------------------------------------------------
| Application Form Macros
|--------------------------------------------------------------------------
|
| Here is where you can register your form macros.
|
*/