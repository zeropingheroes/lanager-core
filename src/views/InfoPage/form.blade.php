{{ HTML::validationErrors($errors) }}

{{ Form::label('title', 'Title') }}
{{ Form::text('title',NULL,array('placeholder' => 'The title of the page', 'maxlength' => 255)) }}

{{ Form::label('content', 'Content') }}
{{ Form::textarea('content',NULL,array('placeholder' => 'The content of the page, markdown formatting enabled', 'rows' => 10)) }}

{{ Form::label('parent_id', 'Parent') }}
{{ Form::select('parent_id', $infoPagesDropdown) }}

{{ Form::actions( Form::submit('Submit') ) }}
