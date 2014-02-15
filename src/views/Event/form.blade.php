{{ HTML::validationErrors() }}

{{ Form::label('name', 'Name') }}
{{ Form::text('name',NULL,array('placeholder' => 'The name of the event', 'maxlength' => 255)) }}

{{ Form::label('description', 'Description') }}
{{ Form::textarea('description',NULL,array('placeholder' => 'The event description, markdown formatting enabled', 'rows' => 10)) }}

<div class="row">
	<div class="col-md-6">
		{{ Form::label('start', 'Start') }}
		{{ Form::text('start', NULL, array('placeholder' => 'DD/MM/YYYY HH:MM')) }}
		{{ HTML::datePicker('start', array('linkedPickerName' => 'end')) }}
	</div>
	<div class="col-md-6">
		{{ Form::label('end', 'End') }}
		{{ Form::text('end', NULL, array('placeholder' => 'DD/MM/YYYY HH:MM')) }}
		{{ HTML::datePicker('end') }}
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		{{ Form::label('event_type_id', 'Type') }}
		{{ Form::select('event_type_id', $eventTypes) }}
	</div>
</div>

<br>

{{ Button::submit('Submit') }}
