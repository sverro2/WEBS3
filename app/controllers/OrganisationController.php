<?php

class OrganisationController extends BaseController {

	public function __construct() {
		parent::__construct();
	}

	public function getIndex()
	{
		return View::orga_home();
	}

	public function getNewEvent(){
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('event.create', $data);
	}

}
