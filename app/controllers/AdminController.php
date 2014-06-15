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
			'Facebook' => 'Open,{facebook}',
			'Website' => 'Website,{website}',
			'Events' => 'Show Events,#organisation/index/{name}'
			);

		$data['data_table'] = DataTable::create_data_table($input, $table_content, "organisation_table");

		return View::make('admin.organisation', $data);
	}

	public function getEvent(){
		$input = AirsoftEvent::All();
		$table_content = array(
			"Event" => "{name}",
			"Start" => "{getSimpleStartDate()}",
			"Organisatie" => "{organisation/name}",
			"Edit" => "Bewerk,#event/edit/{url}",
			"Vol" => "{is_full},,0=>Vrij|1=>Vol"
			);

		$data['data_table'] = DataTable::create_data_table($input, $table_content, "event_table");

		return View::make('admin.events', $data);
	}

	public function getSetting(){
		return View::make('admin.settings');
	}

}
