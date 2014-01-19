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
HTML::macro('resourceCreate', function($resourceName, $buttonValue)
{
	if( Authority::can('create', $resourceName) ) return Button::link(URL::route($resourceName.'.create'), $buttonValue);
});


// Show "Edit" button for a specific resource
HTML::macro('resourceUpdate', function($resourceName, $resourceItem, $buttonValue)
{
	$resourceItemId = (is_object($resourceItem) ? $resourceItem->id : $resourceItem);
	if( Authority::can('update', $resourceName, $resourceItem) ) return Button::link(URL::route($resourceName.'.edit', array($resourceName => $resourceItemId)), $buttonValue);
});


// Show "Delete" button for a specific resource
HTML::macro('resourceDelete', function($resourceName, $resourceItem, $buttonValue)
{
	$resourceItemId = (is_object($resourceItem) ? $resourceItem->id : $resourceItem);
	if( Authority::can('delete', $resourceName, $resourceItem) )
	{
		$output = Form::open(array('route' => array($resourceName.'.destroy', $resourceItemId), 'method' => 'DELETE', 'data-confirm' => 'Are you sure?', 'class' => 'resource-destroy'));
		$output .= Button::submit($buttonValue, array('title' => 'Delete '.$resourceName));
		$output .= Form::close();

		return $output;
	}
});

// Show user avatar with status info
HTML::macro('userAvatar', function($user, $size = 'small', $classes = array())
{
	if( ! is_array($classes) ) $classes = array($classes);
	$classes[] = 'avatar';
	$classes[] = 'avatar-'.$size;
	
	$state = $user->states()->latest();
	
	if( $state->first() )
	{
		if( isset($state->application->steam_app_id) )
		{
			$classes[] = 'in-game';
			$title = 'In-Game: '.e($state->application->name);
		}
		elseif( $state->status )
		{
			$classes[] = 'online';
			$title = $state->getStatus();
		}
		else
		{
			$classes[] = 'offline';
			$title = $state->getStatus();
		}
	}
	else
	{
		$classes[] = 'offline';
		$title = 'Status unknown';
	}
	switch($size)
	{
		case 'small':
			$src = $user->avatar;
			break;
		case 'medium':
			$src = $user->getMediumAvatarUrl();
			break;
		case 'large':
			$src = $user->getLargeAvatarUrl();
			break;
		default: $src = $user->avatar;
	}
	$classes = implode(' ', $classes);
	return'<img	class="'.$classes.'" src="'.$src.'" alt="Avatar" title="'.$title.'">';
});

/*
|--------------------------------------------------------------------------
| Application Form Macros
|--------------------------------------------------------------------------
|
| Here is where you can register your form macros.
|
*/