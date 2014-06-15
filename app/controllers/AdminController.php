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
			'Facebook' => 'toon,{facebook}',
			'Website' => 'link,{website}',
			'Events' => 'open,#organisation/index/{name}',
			'Bewerk' => 'bewerk,#manage/edit-organisation/{name}'
			);

		$data['title'] = "Organisation";
		$data['data_table'] = DataTable::create_data_table($input, $table_content, "organisation_table");

		return View::make('admin.organisation', $data);
	}

	public function getEvent(){
		$input = AirsoftEvent::All();
		$table_content = array(
			"Event" => "{name}",
			"Start" => "{getSimpleStartDate()}",
			"Organisatie" => "{organisation/name}",
			"Vol?" => "{is_full},,0=>Vrij|1=>Vol",
			"Bewerk" => "bewerk event,#manage/edit-event/{url}"
			);

		$data['title'] = "Events";
		$data['data_table'] = DataTable::create_data_table($input, $table_content, "event_table");

		return View::make('admin.events', $data);
	}

	public function getSetting(){
		$data['title'] = "Website Settings";
		return View::make('admin.settings', $data);
	}

}
