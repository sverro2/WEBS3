@extends('layout.base')

@section('content')
	@foreach($events as $event)
		@include('event.elements.eventrow', $event)
	@endforeach
@stop