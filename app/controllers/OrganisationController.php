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

}
