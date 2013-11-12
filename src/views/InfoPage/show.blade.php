@extends('lanager-core::layouts.default')

@section('content')

<h2>{{{$infoPage->title}}}</h2>

{{Markdown::string($infoPage->content)}}

@if(!empty($infoPages))
<br>
<ul>
	@include('lanager-core::infoPage.list')
</ul>
@endif

<br>

{{ Form::open(array('route' => array('info.destroy', $infoPage->id), 'method' => 'DELETE')) }}
{{ link_to_route('info.edit', 'Edit',array('info' => $infoPage->id), array('class' => 'btn')) }}

{{ Form::submit('Delete',array('class' => 'btn btn-danger')) }}
{{ Form::close() }}



@endsection