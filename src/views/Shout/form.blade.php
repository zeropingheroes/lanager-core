@if( Authority::can('create', 'shout') )
	{{ Form::open(array('route' => 'shout.store', 'class' => 'form-inline shout-post')) }}
	{{ HTML::validationErrors() }}

	{{ Form::text('content', NULL, array('placeholder' => 'What\'s going on?', 'maxlength' => 140) ) }}
	{{ Button::inverse_submit('Post') }}
	{{ Form::close() }}
@endif

@if(false)
@endif