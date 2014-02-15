@extends('lanager-core::layouts.default')
@section('content')

<?php $timespan = new Zeropingheroes\LanagerCore\Helpers\Timespan($event->start, $event->end); ?>

<div class="row">
	<div class="col-md-6"><h1>{{{ $event->name }}}</h1></div>
	@if( isset( $event->event_type->name ) ) <div class="col-md-6"><h1 class="pull-right"> {{ $event->event_type->name }}</h1></div> @endif
</div>
<div class="row">
	<div class="col-md-6"><h4>{{ $timespan->naturalFormat() }}</h4></div>
	<div class="col-md-6"><h4 class="pull-right">{{ $timespan->relativeStatus() }}</h4></div>
</div>
<hr>

<p>{{ Markdown::string($event->description) }}</p>

<br>

{{ HTML::resourceUpdate('event',$event->id, 'Edit') }}

{{ HTML::resourceDelete('event',$event->id, 'Delete') }}

@endsection