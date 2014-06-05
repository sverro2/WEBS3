<?php

class ManageController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('auth.manages');
		$this->beforeFilter('csrf', array('only' => 'postCreateEvent'));
	}

	public function getOrganisation($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('organisation.manage', $data);
	}

	public function getCreateEvent($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('organisation.event.create', $data);
	}

	public function postCreateEvent($organisation_url)
	{

		$location_id = Input::get('event-location');
		$organisation_id = Input::get('organisation-id');
		$name = Input::get('event-name');
		$url = preg_replace("/[^A-Za-z0-9]/", "", $name);
		$event = new AirsoftEvent();
		$event->name = $name;
		$event->start = Input::get('event-start');
		$event->end = Input::get('event-end');
		$event->organisation_id = $organisation_id;
		$event->location_id = $location_id;
		$event->url = $url;
		$event->type_id = 4;

		$rules = new RuleSet();
		$rules->name = $event->name;
		$rules->rules = Input::get('event-rules');
		$rules->organisation_id = $organisation_id;
		$rules->save();

		$event->ruleset_id = $rules->id;

		$event->save();

		return Redirect::to('organisation/event/' . $url);
	}
}
