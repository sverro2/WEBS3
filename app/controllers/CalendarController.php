<?php

class CalendarController extends BaseController {

	public function __construct() {

	}

	public function getIndex()
	{
		return Redirect::to('/');
	}

	public function getOrganisation($organisation_name)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_name)->firstOrFail();
		return View::make('organisation', $data);
	}

}
