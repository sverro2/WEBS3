<?php

class AdminController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('auth.admin');
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
			'Event' => 'open,#!organisation/index/{url}',
			'Bewerk' => 'bewerk,#!manage/organisation/{url}'
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
			"Vol?" => "{is_full},,0=>Plaatsen Vrij|1=>Vol",
			"Toon" => "Toon Evenement,#!/#displaymap={id}",
			"Bewerk" => "bewerk,#!manage/edit-event/{organisation/url}/{id}",
			"Remove" => "<a href='#' class='removeEvent' data-eventid='{id}' data-org-url='" . URL::to('manage/remove-event') .
				"/{organisation/url}'><span class='glyphicon glyphicon-remove'></span></a>"
			);

		$data['title'] = "Events";
		$data['data_table'] = DataTable::create_data_table($input, $table_content, "event_table");

		return View::make('admin.events', $data);
	}

	public function getSetting(){
		$data['ytURL'] = Settings::find('ytURL');
		$data['title'] = "Website Settings";

		return View::make('admin.settings', $data);
	}

	public function postSetSettings(){
		$input = Input::get('linkvalue');

		$url = Settings::find('ytURL');
		$url->value = $input;

		$url->save();

	}

}
