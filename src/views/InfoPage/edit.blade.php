@extends('lanager-core::layouts.default')
@section('content')

<h3>Edit Info Page</h3>

{{ Form::model($infoPage, array('route' => array('info.update', $infoPage->id), 'method' => 'PUT')) }}

@include('lanager-core::infoPage.form')

{{ Form::close() }}
@endsection