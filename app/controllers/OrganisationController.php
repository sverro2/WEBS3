<?php

class OrganisationController extends BaseController {

	public function __construct() {
		parent::__construct();
	}

	public function getIndex($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('organisation.organisation', $data);
	}

	public function getEvent($event_url)
	{
		$data['event'] = AirsoftEvent::where('url', '=', $event_url)->firstOrFail();
		return View::make('organisation.event.event', $data);
	}

	public function getEventOverlay($event_id)
	{
		$data['event'] = AirsoftEvent::where('id', '=', $event_id)->firstOrFail();
		return View::make('organisation.event.elements.mapoverlay', $data);
	}

	public function getFacebookEvent()
	{
		$event_id = Input::get('id');
		$facebook_event = new FacebookEvent($event_id);
		return Response::json($facebook_event->toArray());
	}

	public function getEventLocation()
	{
		$event_id = Input::get('id');
		$event = AirsoftEvent::where('id', '=', $event_id)->firstOrFail();
		$coords = array($event->location->coordinates);
		return Response::json($coords);
	}

	public function getAllLocations()
	{
		$data = Location::all();
		return Response::json($data);
	}


}
