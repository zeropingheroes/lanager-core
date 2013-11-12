{{ Form::label('name', 'Title') }}
{{ Form::text('title',$infoPage->title,array('placeholder' => 'The title of the page', 'maxlength' => 255)) }}
<br>
{{ Form::label('content', 'Content') }}
{{ Form::textarea('content',$infoPage->content,array('placeholder' => 'The content of the page, markdown formatting enabled', 'rows' => 10)) }}
<br>
{{ Form::label('parent_id', 'Parent') }}
{{ Form::select('parent_id', $infoPagesDropdown, $infoPage->parent_id) }}
<br>
<br>
{{ Form::submit('Submit',array('class' => 'btn')) }}