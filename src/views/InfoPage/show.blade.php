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

{{ HTML::resourceButtons('infoPage',$infoPage->id) }}

@endsection