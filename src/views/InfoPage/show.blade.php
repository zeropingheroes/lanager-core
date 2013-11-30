@extends('lanager-core::layouts.default')
@section('content')

<h2>{{{ $infoPage->title }}}</h2>

{{ Markdown::string($infoPage->content) }}

@if(!empty($infoPages))
	<br>
	<ul>
		@include('lanager-core::infoPage.list')
	</ul>
@endif

<br>

{{ Form::open(array('route' => array('info.destroy', $infoPage->id), 'method' => 'DELETE', 'data-confirm' => 'Are you sure?')) }}

{{ Form::actions( array(
	Button::link(route('info.edit', array('info' => $infoPage->id)), 'Edit'),
	Button::danger_submit('Delete'))
	)
}}

{{ Form::close() }}

@endsection