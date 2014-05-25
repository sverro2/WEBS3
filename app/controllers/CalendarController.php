<?php

class CalendarController extends BaseController {

	public function __construct() {
		parent::__construct();
	}

	public function getIndex()
	{
		return Redirect::to('/');
	}

	public function getOrganisation($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('calendar.organisation', $data);
	}

}
