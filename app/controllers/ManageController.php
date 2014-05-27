<?php

class ManageController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('auth.manages');
	}

	public function getOrganisation($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('organisation.manage', $data);
	}

	public function getCreateEvent($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		$data['rules'] = Rule::all();
		return View::make('organisation.event.create', $data);
	}
}
