<?php

class AdminController extends BaseController {

	public function __construct() {
		parent::__construct();
		//$this->beforeFilter('auth.admin');
	}

	public function getIndex()
	{
		return View::make('admin.home');
	}

	public function getBootstrap(){
		return View::make('admin.bootstrap');
	}

	public function getOrganisation(){
		$input = Organisation::All();
		$table_content = array(
			'Organisatie' => '{name}',
			'Facebook' => '{facebook},Open',
			'Website' => '{website},Website',
			'Events' => '#organisation/index/{name},Show Events'
			);

		$data['data_table'] = DataTable::create_data_table($input, $table_content, "organisation_table");

		return View::make('admin.organisation', $data);
	}

	public function getEvent(){
		$input = AirsoftEvent::All();
		$table_content = array(
			"Event" => "{name}",
			"Start" => "{getSimpleStartDate()}",
			"Edit" => "#event/edit/{url},Bewerk"
			);

		$data['data_table'] = DataTable::create_data_table($input, $table_content, "organisation_table");

		return View::make('admin.events', $data);
	}

	public function getSetting(){
		return View::make('admin.settings');
	}

}
