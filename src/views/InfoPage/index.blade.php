@extends('lanager-core::layouts.default')

@section('content')

<h2>Info</h2>

<ul>
@include('lanager-core::infoPage.list')
</ul>
<br>
{{ link_to_route('info.create', 'Create', NULL, array('class' => 'btn')) }}


@endsection