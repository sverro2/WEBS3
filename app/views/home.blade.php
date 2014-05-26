@extends('layout.base')

@section('content')
	@foreach($events as $event)
		@include('organisation.event.elements.eventrow', $event)
	@endforeach
@stop