@if( $errors->count() > 0 )
	<div class="alert alert-error">
		<p><strong>The following errors occurred</strong></p>
		<ul>
			@foreach($errors->all('<li>:message</li>') as $error)
				{{$error}}
			@endforeach
		</ul>
	</div>
@endif

{{ Form::label('title', 'Title') }}
{{ Form::text('title',NULL,array('placeholder' => 'The title of the page', 'maxlength' => 255)) }}
<br>
{{ Form::label('content', 'Content') }}
{{ Form::textarea('content',NULL,array('placeholder' => 'The content of the page, markdown formatting enabled', 'rows' => 10)) }}
<br>
{{ Form::label('parent_id', 'Parent') }}
{{ Form::select('parent_id', $infoPagesDropdown) }}
<br>
<br>
{{ Form::submit('Submit',array('class' => 'btn')) }}