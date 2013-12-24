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
			'<strong>The following errors occurred</strong>'.
			HTML::ul($errors->all(':message'))
		);
	}
});

// Update and/or delete buttons for priviledged users
HTML::macro('resourceButtons', function($resourceName,$itemId)
{
	// For users who can update, generate a button
	$updateButton = ( Authority::can('update',$resourceName) ? Button::link(URL::route($resourceName.'.edit', array($resourceName => $itemId)), 'Edit') : '' );

	// For users who can delete, generate a button
	if( Authority::can('delete',$resourceName) )
	{
		$output = Form::open(array('route' => array($resourceName.'.destroy', $itemId), 'method' => 'DELETE', 'data-confirm' => 'Are you sure?'));
		$output .= Form::actions( array(
			// Insert the update button (will be an empty var for users who can't update)
			$updateButton,
			Button::danger_submit('Delete'))
			);
		$output .= Form::close();
	}
	else
	{
		$output = $updateButton;
	}
	return $output;

});

/*
|--------------------------------------------------------------------------
| Application Form Macros
|--------------------------------------------------------------------------
|
| Here is where you can register your form macros.
|
*/