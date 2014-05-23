@extends('layout.base')

@section('content')
	@foreach($events as $event)
		@include('calendar.elements.eventrow', $event)
	@endforeach
@stop