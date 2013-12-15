@extends('lanager-core::layouts.default')
@section('content')

<h2>Info</h2>

<ul>
	@include('lanager-core::infoPage.list')
</ul>
<br>
@if( Authority::can('create','InfoPage') )
	{{ Button::link(route('infoPage.create'), 'Create') }}
@endif

@endsection