@extends('lanager-core::layouts.default')
@section('content')

<?php
	$event->start = date('d/m/Y H:i', strtotime($event->start));
	$event->end = date('d/m/Y H:i', strtotime($event->end));
?>

<h3>{{ $title }}</h3>

{{ Form::model($event, array('route' => array('event.update', $event->id), 'method' => 'PUT')) }}

@include('lanager-core::event.form')

{{ Form::close() }}
@endsection