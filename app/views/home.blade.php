@extends('layout.base')

@section('bodycontent')
    <div id="yt" data-url="{{ @$ytURL->value }}"></div>
    <div id="raster"></div>
@stop

@section('content')
	@foreach($events as $event)
		@include('organisation.event.elements.eventrow_textual', $event)
	@endforeach
@stop