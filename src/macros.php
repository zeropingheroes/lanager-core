<?php

/*
|--------------------------------------------------------------------------
| Application HTML Macros
|--------------------------------------------------------------------------
|
| Here is where you can register your HTML macros.
|
*/

// Show validation errors wrapped in bootstrap style
HTML::macro('validationErrors', function()
{
	$errors = Session::get('errors');
	if( $errors )
	{
		return Alert::error(
			'<strong>The following errors occurred</strong>'.
			HTML::ul($errors->all(':message'))
		);
	}
});


// Show "Create" button for a resource
HTML::macro('resourceCreate', function($resource, $buttonValue)
{
	if( Authority::can('create', $resource) ) return Button::link(URL::route($resource.'.create'), $buttonValue);
});


// Show "Edit" button for a specific resource
HTML::macro('resourceUpdate', function($resource, $id, $buttonValue)
{
	if( Authority::can('update', $resource, $id) ) return Button::link(URL::route($resource.'.edit', array($resource => $id)), $buttonValue);
});


// Show "Delete" button for a specific resource
HTML::macro('resourceDelete', function($resource, $id, $buttonValue)
{
	if( Authority::can('delete', $resource, $id) )
	{
		$output = Form::open(array('route' => array($resource.'.destroy', $id), 'method' => 'DELETE', 'data-confirm' => 'Are you sure?', 'class' => 'resource-destroy'));
		$output .= Button::submit($buttonValue, array('title' => 'Delete '.$resource));
		$output .= Form::close();

		return $output;
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