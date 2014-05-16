@extends('layout.calendar')

@section('events')
	@foreach($events as $event)
		@include('layout.elements.eventrow', $event)
	@endforeach
@stop