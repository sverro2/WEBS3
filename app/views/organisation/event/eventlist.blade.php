@foreach($events as $event)
	@include('organisation.event.elements.eventrow_textual', $event)
@endforeach