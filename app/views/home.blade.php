@extends('layout.base')

@section('content')
	@foreach($events as $event)
		@include('layout.elements.eventrow', $event)
	@endforeach
@stop